<?php

namespace App\Components;

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
     * @var
     */
    private $delimiter;

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

    /**
     * @param $value
     * @return $this
     */
    public function setDelimiter($value)
    {
        $this->delimiter = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @return bool
     */
    public function isPropertyCondition()
    {
        return strpos($this->getField(), "property-") !== false;
    }

    /**
     * @return mixed
     */
    public function getPropertyConditionId()
    {
        return array_get(explode("-", $this->getField()), 1);
    }
}
