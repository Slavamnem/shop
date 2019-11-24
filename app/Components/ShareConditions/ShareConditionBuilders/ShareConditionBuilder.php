<?php

namespace App\Components\ShareConditions\ShareConditionBuilders;

use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\Delimiter;
use App\Components\ShareConditions\Interfaces\ShareConditionBuilderInterface;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;

class ShareConditionBuilder implements ShareConditionBuilderInterface //unused
{
    /**
     * @var ShareConditionsFactory
     */
    private $factory;
    /**
     * @var ConditionBox
     */
    private $conditionsBox;

    /**
     * @param ShareConditionsFactory $factory
     * @return $this
     */
    public function createBox(ShareConditionsFactory $factory)
    {
        $this->factory = $factory;

        $this->conditionsBox = $this->factory->getConditionBox();

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
     * @param $id
     * @return $this
     */
    public function setBoxPid($id)
    {
        $this->conditionsBox->setPid($id);
        return $this;
    }

    /**
     * @param Delimiter $delimiter
     * @return $this
     */
    public function setBoxDelimiter(Delimiter $delimiter)
    {
        $this->conditionsBox->setDelimiter($delimiter);
        return $this;
    }

    /**
     * @param ConditionBlock $conditionBlock
     * @return $this|ShareConditionBuilderInterface
     */
    public function addBoxChild(ConditionBlock $conditionBlock)
    {
        $this->conditionsBox->addChild($conditionBlock);

        return $this;
    }

    /**
     * @param $id
     * @return ConditionBlock|null
     */
    public function getChild($id)
    {
        return $this->conditionsBox->getChildById($id);
    }

    /**
     * @return ConditionBox
     */
    public function getConditionBox()
    {
        return $this->conditionsBox;
    }
}
