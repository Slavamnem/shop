<?php

namespace App\Components\ShareConditions\Interfaces;

use App\Components\Condition;
use App\Components\ConditionsBox;

interface ShareConditionBuilderInterface
{
    /**
     * @param ShareConditionsFactory $factory
     * @return $this
     */
    public function createBox(ShareConditionsFactory $factory);

    /**
     * @param $id
     * @return $this
     */
    public function setBoxId($id);

    /**
     * @param Delimiter $delimiter
     * @return $this
     */
    public function setDelimiter(Delimiter $delimiter);

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
     * @return ConditionsBox
     */
    public function getConditionsBox();
}