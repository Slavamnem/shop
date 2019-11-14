<?php

namespace App\Components\ShareConditions\ShareConditionBuilders;

use App\Builders\Interfaces\ConditionsBuilderInterface;
use App\Components\Condition;
use App\Components\ConditionsBox;
use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\Delimiter;
use App\Components\ShareConditions\Interfaces\ShareConditionBuilderInterface;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;
use Illuminate\Support\Collection;

class ShareConditionBuilder implements ShareConditionBuilderInterface
{
    /**
     * @var ConditionBlock
     */
    private $conditionsBox;

    /**
     * @param ShareConditionsFactory $factory
     * @return $this
     */
    public function createBox(ShareConditionsFactory $factory)
    {
        $this->conditionsBox = $factory->getConditionBox();
        return $this;
    }

    /**
     * @param $id
     * @return $this
     */
    public function setBoxId($id)
    {
        $this->conditionsBox->setId($id);
        return $this;
    }

    /**
     * @param Delimiter $delimiter
     * @return $this
     */
    public function setDelimiter(Delimiter $delimiter)
    {
        $this->conditionsBox->setDelimiter($delimiter);
        return $this;
    }

    /**
     * @param Condition $condition
     */
    public function addCondition(Condition $condition)
    {
        $this->conditionsBox->addCondition($condition);
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
