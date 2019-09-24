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
use App\Enums\SecurityStatusEnum;
use Illuminate\Support\Facades\Log;

class AppCenter implements AppCenterInterface
{
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

    public function sendSignal(SignalInterface $signal)
    {
        Log::info('update in AppCenter');
        $this->checkAccess();
    }

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

    private function blockUser()
    {
        $this->security->blockUser();
        $this->security->turnOffAdminPanelAccess();
    }
}
