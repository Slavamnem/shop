<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 23:31
 */

namespace App\Components\ShareConditions\Interfaces;

use Illuminate\Support\Collection;

interface ConditionBlock
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function setId($id);

    /*
     * @return mixed
     */
    public function getParentId();

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function setParentId($id);

    /**
     * @param ConditionStatus $status
     * @return ConditionBlock
     */
    public function changeStatus(ConditionStatus $status) : ConditionBlock;

    /**
     * @return ConditionStatus
     */
    public function getStatus() : ConditionStatus;

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @param mixed $type
     * @return ConditionBlock
     */
    public function setType($type) : ConditionBlock;

    /**
     * @param $value
     * @return $this
     */
    public function setField($value);

    /**
     * @return mixed
     */
    public function getField();

    /**
     * @return string
     */
    public function getOperation(): string;

    /**
     * @param string $operation
     * @return ConditionBlock
     */
    public function setOperation(string $operation): ConditionBlock;

    /**
     * @return mixed
     */
    public function getCurrentValue();

    /**
     * @param $value
     * @return $this
     */
    public function setCurrentValue($value);

    /**
     * @param ConditionBlock $conditionBlock
     * @return ConditionBlock
     */
    public function addChildConditionBlock(ConditionBlock $conditionBlock);

    /**
     * @param $id
     * @return ConditionBlock|null
     */
    public function getChildConditionBlock($id) : ConditionBlock;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getChildConditionBlocks() : Collection;

    /**
     * @return ConditionsFieldsListInterface
     */
    public function getFieldsList(): ConditionsFieldsListInterface;

    /**
     * @param ConditionsFieldsListInterface $fieldsList
     * @return ConditionBlock
     */
    public function setFieldsList(ConditionsFieldsListInterface $fieldsList): ConditionBlock;

    /**
     * @return OperationList
     */
    public function getOperationsList(): OperationList;

    /**
     * @param OperationList $operationsList
     * @return ConditionBlock
     */
    public function setOperationsList(OperationList $operationsList): ConditionBlock;

    /**
     * @return Delimiter
     */
    public function getDelimiter(): Delimiter;

    /**
     * @param Delimiter $delimiter
     * @return ConditionBlock
     */
    public function setDelimiter(Delimiter $delimiter): ConditionBlock;

    public function show();
}
