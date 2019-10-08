<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.09.2019
 * Time: 23:46
 */

namespace App\Components;

use App\Components\Interfaces\AppCenterInterface;
use App\Components\Interfaces\SecurityCenterInterface;
use App\Components\Interfaces\SignalInterface;
use App\Components\Signals\AuthFailSignal;
use App\Components\Signals\DeleteRecordSignal;
use App\Components\Signals\TrojanHorseSignal;
use App\Enums\SecurityStatusEnum;
use App\Enums\UserActionsEnum;
use App\Events\Attack;
use App\Events\MessageToTelegram;
use App\UserAction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class AppCenter implements AppCenterInterface
{
    const MAX_SAFE_DELETIONS = 5;
    const MAX_LOGIN_ATTEMPTS = 5;

    /**
     * @var SecurityCenterInterface
     */
    private $security;

    /**
     * AppCenter constructor.
     * @param SecurityCenterInterface $security
     */
    public function __construct(SecurityCenterInterface $security)
    {
        $this->security = $security;
    }

    /**
     * @param SignalInterface $signal
     */
    public function sendSignal(SignalInterface $signal)
    {
        if ($signal instanceof DeleteRecordSignal) {
            $this->reactToDeleteRecord($signal);
        } elseif ($signal instanceof AuthFailSignal) {
            $this->reactToAuthFail($signal);
        } elseif ($signal instanceof TrojanHorseSignal) {
            $this->reactToTrojanHorse($signal);
        }
    }

    /**
     * @param SignalInterface $signal
     */
    public function reactToTrojanHorse(SignalInterface $signal)
    {
        $this->blockUser();
        Event::fire(new Attack('Троянский конь. Попытка загрузки потенциально опасного файла.'));
        exit();
    }

    /**
     * @param SignalInterface $signal // TODO strategy
     */
    private function reactToDeleteRecord(SignalInterface $signal)
    {
        $currentDeletionsCount = UserAction::query()
            ->where('user_id', Auth::id())
            ->whereNotNull('user_id')
            ->where('type', UserActionsEnum::DELETE_RECORD)
            ->whereDate('created_at', '>=', Carbon::today()->toDateTimeString())
            ->count();

        //Event::fire(new MessageToTelegram(json_encode(Session::all())));

        if ($currentDeletionsCount >= self::MAX_SAFE_DELETIONS) {
            $this->blockUser();
        }

        UserAction::create([
            'type' => UserActionsEnum::DELETE_RECORD,
            'user_id' => Auth::id(),
            'description' => $signal->getMessage()
        ]);
    }

    /**
     * @param SignalInterface $signal
     */
    private function reactToAuthFail(SignalInterface $signal)
    {
        Event::fire(new MessageToTelegram('Неудачная попытка входа в админ панель'));

        $currentAuthFailsCount = UserAction::query()
            ->where('ip_address', $this->security->getUserIp())
            ->where('type', UserActionsEnum::LOGIN_FAIL)
            ->whereDate('created_at', '>=', Carbon::today()->toDateTimeString())
            ->count();

        if ($currentAuthFailsCount >= self::MAX_LOGIN_ATTEMPTS) {
            $this->blockUser();
        }

        UserAction::create([
            'type' => UserActionsEnum::LOGIN_FAIL,
            'ip_address' => $this->security->getUserIp(),
            'description' => $signal->getMessage()
        ]);

        //Event::fire(new MessageToTelegram(json_encode(Session::all())));
    }

    private function blockUser()
    {
        $this->security->blockUser();
        $this->security->turnOffAdminPanelAccess();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    public function call($method, $arguments)
    {
        if (method_exists($this, $method)) {
            call_user_func([$this, $method], $arguments);
        }
    }

    private function checkAccess()
    {
        $responseStatus = $this->security->checkAccess();

        switch ($responseStatus) {
            case SecurityStatusEnum::ATTACK:
                $this->blockUser();
        }
    }
}
