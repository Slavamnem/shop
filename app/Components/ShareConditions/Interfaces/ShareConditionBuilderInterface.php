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
     * @param $id
     * @return $this
     */
    public function setParentId($id);

    /**
     * @param Delimiter $delimiter
     * @return $this
     */
    public function setDelimiter(Delimiter $delimiter);

    /**
     * @param ConditionBlock $conditionBlock
     * @return $this
     */
    public function addConditionBlock(ConditionBlock $conditionBlock);

    /**
     * @param ConditionsFieldsListInterface $conditionsList
     * @return $this
     */
    public function setFieldsList(ConditionsFieldsListInterface $conditionsList);

    /**
     * @param OperationList $operationsList
     */
    public function setOperationsList(OperationList $operationsList);

    /**
     * @param $id
     * @param $valuesList
     */
    public function setValuesList($id, $valuesList);

    /**
     * @param $id
     * @return Condition
     */
    public function getChildConditionBlock($id);

    /**
     * @return ConditionBlock
     */
    public function getConditionBlock();
}