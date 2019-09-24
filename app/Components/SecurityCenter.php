<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.09.2019
 * Time: 0:01
 */

namespace App\Components;

use App\AdminAuth;
use App\Components\Helpers\SecurityHelper;
use App\Components\Interfaces\SecurityCenterInterface;
use App\Enums\SecurityStatusEnum;
use App\Events\Attack;
use App\Notifications\AttackNotification;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class SecurityCenter implements SecurityCenterInterface
{
    /**
     * @return bool
     */
    public function checkUserIp()
    {
        return !(bool)DB::table('black_list')
            ->where('ip', '=', $this->getUserIp())
            ->where(function($query){
                $query->where('unblock_at', '>', Carbon::now()->toDateTimeString())
                    ->orWhereNull('unblock_at');
            })
            ->count();
    }

    public function requestHasThreat()
    {
        $request = request();

        foreach ($request->all() as $requestItem) {
            if (SecurityHelper::hasForbiddenSymbols($requestItem)) {
                Log::info('request has danger');
                //$this->blockUser();
                //$this->turnOffAdminPanelAccess();
                return true;
            }
        }
        Log::info('request is safe');
        return false;
    }

    public function checkAccess()
    {
        return SecurityStatusEnum::ATTACK;
    }

    public function blockUser()
    {
        try {
            DB::table('black_list')->insert([
                'ip' => $this->getUserIp()
            ]);
        } catch (\Exception $e) {
            Log::info('Error. Trying to insert black ip which already exists.');
        }
    }

    public function turnOffAdminPanelAccess()
    {
        Event::fire(new Attack());

        $envFile = file_get_contents('./.env');

        $envFile = str_replace('ADMIN_PANEL_ACCESS=1', 'ADMIN_PANEL_ACCESS=0', $envFile);

        file_put_contents('./.env', $envFile);
    }

    /**
     * @return mixed
     */
    private function getUserIp()
    {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }
}
