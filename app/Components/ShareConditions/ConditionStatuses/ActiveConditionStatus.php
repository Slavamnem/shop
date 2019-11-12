<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:42
 */

namespace App\Components\ShareConditions\ConditionStatuses;

use App\Components\ShareConditions\Interfaces\ConditionStatus;

class ActiveConditionStatus implements ConditionStatus
{
    /**
     * @return string
     */
    public function getStatusText() : string
    {
        return 'Активное условие';
    }

    /**
     * @return string
     */
    public function getStatusColor() : string
    {
        return 'green';
    }
}
