<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:35
 */

namespace App\Components\ShareConditions\Factory;

use App\Components\ShareConditions\ConditionBoxes\BaseConditionBox;
use App\Components\ShareConditions\Conditions\BaseCondition;
use App\Components\ShareConditions\ConditionsFieldsList;
use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\ConditionsFieldsListInterface;
use App\Components\ShareConditions\Interfaces\OperationList;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;
use App\Components\ShareConditions\OperationLists\BaseOperationList;

class BaseShareConditionsFactory implements ShareConditionsFactory
{
    /**
     * @return ConditionBlock
     */
    public function getConditionBox(): ConditionBlock
    {
        return new BaseConditionBox();
    }

    /**
     * @return ConditionBlock
     */
    public function getCondition(): ConditionBlock
    {
        return new BaseCondition();
    }

    /**
     * @return OperationList
     */
    public function getOperationList(): OperationList
    {
        return new BaseOperationList();
    }

    /**
     * @return ConditionsFieldsListInterface
     */
    public function getFieldsList() : ConditionsFieldsListInterface
    {
        return new ConditionsFieldsList();
    }
}
