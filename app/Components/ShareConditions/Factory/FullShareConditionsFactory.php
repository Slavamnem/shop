<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:35
 */

namespace App\Components\ShareConditions\Factory;

use App\Components\ShareConditions\Interfaces\Condition;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\OperationList;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;
use App\Components\ShareConditions\OperationLists\FullOperationList;

class FullShareConditionsFactory implements ShareConditionsFactory
{
    /**
     * @return ConditionBox
     */
    public function getConditionBox(): ConditionBox
    {
        return null;
    }

    /**
     * @return Condition
     */
    public function getCondition(): Condition
    {
        return null;
    }

    /**
     * @return OperationList
     */
    public function getOperationList(): OperationList
    {
        return new FullOperationList();
    }
}
