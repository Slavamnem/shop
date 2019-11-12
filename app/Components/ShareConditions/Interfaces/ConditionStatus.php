<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:05
 */

namespace App\Components\ShareConditions\Interfaces;

interface ConditionStatus
{
    /**
     * @return string
     */
    public function getStatusText() : string;

    /**
     * @return string
     */
    public function getStatusColor() : string;
}
