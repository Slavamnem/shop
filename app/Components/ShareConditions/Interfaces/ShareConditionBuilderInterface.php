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
    public function setBoxPid($id);

    /**
     * @param Delimiter $delimiter
     * @return $this
     */
    public function setBoxDelimiter(Delimiter $delimiter);

    /**
     * @param ConditionBlock $conditionBlock
     * @return $this|ShareConditionBuilderInterface
     */
    public function addBoxChild(ConditionBlock $conditionBlock);

//    /**
////     * @param ConditionsFieldsListInterface $conditionsList
////     * @return $this
////     */
////    public function setFieldsList(ConditionsFieldsListInterface $conditionsList);
////
////    /**
////     * @param OperationsList $operationsList
////     */
////    public function setOperationsList(OperationsList $operationsList);
////
////    /**
////     * @param $id
////     * @param $valuesList
////     */
////    public function setValuesList($id, $valuesList);

    /**
     * @param $id
     * @return ConditionBlock|null
     */
    public function getChild($id);

    /**
     * @return ConditionBox
     */
    public function getConditionBox();
}