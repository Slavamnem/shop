<?php

namespace App\Components;

use App\Enums\ConditionDelimiterTypesEnum;
use Illuminate\Support\Collection;

class ConditionsBox
{
    /**
     * @var Collection
     */
    private $conditions;
    /**
     * @var string
     */
    private $delimiter;
    /**
     * @var
     */
    private $fieldsList;
    /**
     * @var
     */
    private $operationsList;

    public function __construct()
    {
        $this->conditions = collect();
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getConditions()
    {
        return $this->conditions;
    }

    /**
     * @param Condition $condition
     */
    public function addCondition(Condition $condition)
    {
        $this->conditions->put($condition->getId(), $condition);
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getCondition($id)
    {
        return $this->conditions->get($id);
    }

    /**
     * @param $value
     */
    public function setDelimiter($value)
    {
        $this->delimiter = $value;
    }

    /**
     * @return mixed
     */
    public function getDelimiter()
    {
        return $this->delimiter;
    }

    /**
     * @return mixed
     */
    public function getDelimiterTrans()
    {
        return ConditionDelimiterTypesEnum::getTranslation($this->getDelimiter());
    }

    /**
     * @param $conditions
     * @return $this
     */
    public function setConditionsList($conditions)
    {
        $this->fieldsList = $conditions;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getConditionsList()
    {
        return $this->fieldsList;
    }

    /**
     * @param $operations
     * @return $this
     */
    public function setOperationsList($operations)
    {
        $this->operationsList = $operations;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getOperationsList()
    {
        return $this->operationsList;
    }
}
