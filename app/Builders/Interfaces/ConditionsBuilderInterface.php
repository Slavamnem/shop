<?php

namespace App\Builders\Interfaces;

use App\Components\Condition;

interface ConditionsBuilderInterface
{
    public function createBox();

    /**
     * @param $value
     */
    public function setDelimiter($value);

    /**
     * @param Condition $condition
     * @return mixed
     */
    public function addCondition(Condition $condition);

    /**
     * @param $conditionsList
     */
    public function setConditionsList($conditionsList);

    /**
     * @param $operationsList
     */
    public function setOperationsList($operationsList);

    /**
     * @param $id
     * @param $valuesList
     */
    public function setValuesList($id, $valuesList);

    /**
     * @param $id
     * @return Condition
     */
    public function getCondition($id);

    /**
     * @return mixed
     */
    public function getConditionsBox();
}