<?php

namespace App\Builders;

use App\Builders\Interfaces\ConditionsBuilderInterface;
use App\Components\Condition;
use App\Components\ConditionsBox;
use Illuminate\Support\Collection;

class ConditionsBuilder implements ConditionsBuilderInterface
{
    /**
     * @var ConditionsBox
     */
    private $conditionsBox;

    public function createBox()
    {
        $this->conditionsBox = new ConditionsBox();
    }

    /**
     * @param $value
     */
    public function setDelimiter($value)
    {
        $this->conditionsBox->setDelimiter($value);
    }

    /**
     * @param $id
     * @param Condition $condition
     */
    public function addCondition($id, $condition)
    {
        $this->conditionsBox->addCondition($id, $condition);
    }

    /**
     * @param $conditionsList
     */
    public function setConditionsList($conditionsList)
    {
        $this->conditionsBox->setConditionsList($conditionsList);
    }

    /**
     * @param $operationsList
     */
    public function setOperationsList($operationsList)
    {
        $this->conditionsBox->setOperationsList($operationsList);
    }

    /**
     * @param $id
     * @param $valuesList
     */
    public function setValuesList($id, $valuesList)
    {
        $this->getCondition($id)->setValuesList($valuesList);
    }

    /**
     * @param $id
     * @return Condition
     */
    public function getCondition($id)
    {
        return $this->conditionsBox->getCondition($id);
    }

    /**
     * @return mixed
     */
    public function getConditionsBox()
    {
        return $this->conditionsBox;
    }
}