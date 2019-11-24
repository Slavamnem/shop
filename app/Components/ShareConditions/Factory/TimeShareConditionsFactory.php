<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:35
 */

namespace App\Components\ShareConditions\Factory;

use App\Components\ShareConditions\ConditionsFieldsList;
use App\Components\ShareConditions\Interfaces\Condition;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\ConditionsFieldsListInterface;
use App\Components\ShareConditions\Interfaces\OperationsList;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;
use App\Components\ShareConditions\OperationLists\FullOperationsList;

class TimeShareConditionsFactory implements ShareConditionsFactory
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
     * @return OperationsList
     */
    public function getOperationList(): OperationsList
    {
        return new FullOperationsList();
    }

    /**
     * @return ConditionsFieldsListInterface
     */
    public function getFieldsList() : ConditionsFieldsListInterface
    {
        return new ConditionsFieldsList();
    }
}
