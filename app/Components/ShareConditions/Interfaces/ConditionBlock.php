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
