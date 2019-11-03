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
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class SecurityCenter implements SecurityCenterInterface
{
    /**
     * Защищает от загрузки вредоносных файлов, sql-инъекций, xss-атак
     */

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

    /**
     * @return bool
     */
    public function requestHasThreat()
    {
        $request = request();

        foreach ($request->all() as $requestItem) {
            if (SecurityHelper::hasForbiddenSymbols($requestItem)) {
                Log::info('request has danger');
                Log::info('request: ' . json_encode($request->all(), JSON_UNESCAPED_UNICODE));
                //$this->blockUser();
                //$this->turnOffAdminPanelAccess();
                //return true;
                return false;
            }
        }
        //Log::info('request is safe');
        return false;
    }

    /**
     * @param $image
     * @return bool
     */
    public function checkImage($image)
    {
        return (
            in_array($image->extension(), config('files.allowed-extensions')) &&
            filesize($image) <= config('files.max-file-upload-size')
        );
    }

    // TODO something with this - unused
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

    /**
     * Close any access to admin panel for everybody
     */
    public function turnOffAdminPanelAccess()
    {
        Event::fire(new Attack());

        $envFile = file_get_contents('./.env');

        $envFile = str_replace('ADMIN_PANEL_ACCESS=1', 'ADMIN_PANEL_ACCESS=0', $envFile);

        //file_put_contents('./.env', $envFile);
    }

    /**
     * @return mixed
     */
    public function getUserIp()
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
