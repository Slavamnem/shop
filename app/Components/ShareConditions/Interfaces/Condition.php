<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:05
 */

namespace App\Components\ShareConditions\Interfaces;

use Illuminate\Support\Collection;

interface Condition extends ConditionBlock
{
    /**
     * @return string
     */
    public function getField();

    /**
     * @param $value
     * @return Condition
     */
    public function setField($value) : Condition;

    /**
     * @return string
     */
    public function getOperationId(): string;

    /**
     * @param string $id
     * @return Condition
     */
    public function setOperationId($id): Condition;

    /**
     * @return string
     */
    public function getValue();

    /**
     * @param $value
     * @return Condition
     */
    public function setValue($value) : Condition;

    /**
     * @return ConditionsFieldsListInterface
     */
    public function getFieldsList(): ConditionsFieldsListInterface;

    /**
     * @param ConditionsFieldsListInterface $fieldsList
     * @return Condition
     */
    public function setFieldsList(ConditionsFieldsListInterface $fieldsList): Condition;

    /**
     * @return OperationsList
     */
    public function getOperationsList(): OperationsList;

    /**
     * @param OperationsList $operationsList
     * @return Condition
     */
    public function setOperationsList(OperationsList $operationsList): Condition;

    /**
     * @return Collection
     */
    public function getValuesList() : Collection;
}
