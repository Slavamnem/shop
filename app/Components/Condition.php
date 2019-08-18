<?php

namespace App\Components;

use App\Enums\ConditionDelimiterTypesEnum;

class Condition
{
    /**
     * @var
     */
    private $id;
    /**
     * @var
     */
    private $field;
    /**
     * @var
     */
    private $operation;
    /**
     * @var
     */
    private $currentValue;
    /**
     * @var
     */
    private $valuesList;

    /**
     * Condition constructor.
     * @param null $id
     */
    public function __construct($id = null)
    {
        $this->id = $id;
    }

    /**
     * @param $id
     * @param $conditionData
     * @return Condition
     */
    public static function createFromShareData($id, $conditionData)
    {
        return (new self())
            ->setId($id)
            ->setField(array_get($conditionData[array_keys($conditionData)[0]], 'field'))
            ->setOperation(array_get($conditionData[array_keys($conditionData)[0]], 'operation'))
            ->setCurrentValue(array_get($conditionData[array_keys($conditionData)[0]], 'value'));
    }

    /**
     * @param $value
     * @return $this
     */
    public function setId($value)
    {
        $this->id = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setField($value)
    {
        $this->field = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getField()
    {
        return $this->field;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setOperation($value)
    {
        $this->operation = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOperation()
    {
        return $this->operation;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setCurrentValue($value)
    {
        $this->currentValue = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCurrentValue()
    {
        return $this->currentValue;
    }

    /**
     * @param $values
     * @return $this
     */
    public function setValuesList($values)
    {
        $this->valuesList = $values;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValuesList()
    {
        return $this->valuesList;
    }
}