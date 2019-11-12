<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:47
 */

namespace App\Components\ShareConditions\Conditions;

use App\Components\ShareConditions\Interfaces\ConditionStatus;

abstract class AbstractCondition
{
    protected $type;
    /**
     * @var ConditionStatus
     */
    protected $status;

    /**
     * @param ConditionStatus $status
     */
    public function changeStatus(ConditionStatus $status)
    {
        $this->status = $status;
    }

    /**
     * @return ConditionStatus
     */
    public function getStatus() : ConditionStatus
    {
        return $this->status;
    }
}
