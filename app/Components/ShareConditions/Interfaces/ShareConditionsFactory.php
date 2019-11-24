<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:04
 */

namespace App\Components\ShareConditions\Interfaces;

interface ShareConditionsFactory
{
    /**
     * @return ConditionBox
     */
    public function getConditionBox() : ConditionBox;

    /**
     * @return Condition
     */
    public function getCondition() : Condition;

    /**
     * @return OperationsList
     */
    public function getOperationList() : OperationsList;

    /**
     * @return ConditionsFieldsListInterface
     */
    public function getFieldsList() : ConditionsFieldsListInterface;
}
