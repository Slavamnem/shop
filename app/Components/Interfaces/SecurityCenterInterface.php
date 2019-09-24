<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 24.09.2019
 * Time: 0:01
 */

namespace App\Components\Interfaces;

interface SecurityCenterInterface
{
    public function checkAccess();

    public function blockUser();

    public function turnOffAdminPanelAccess();
}