<?php

namespace App\Components\ShareConditions\ShareConditionBuilders;

use App\Builders\Interfaces\ConditionsBuilderInterface;
use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\ConditionsFieldsListInterface;
use App\Components\ShareConditions\Interfaces\Delimiter;
use App\Components\ShareConditions\Interfaces\OperationList;
use App\Components\ShareConditions\Interfaces\ShareConditionBuilderInterface;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;
use Illuminate\Support\Collection;

class ShareConditionBuilder implements ShareConditionBuilderInterface
{
    /**
     * @var ShareConditionsFactory
     */
    private $factory;
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
        $this->factory = $factory;

        $this->conditionsBox = $this->factory->getConditionBox()
            ->setFieldsList($this->factory->getFieldsList())
            ->setOperationsList($this->factory->getOperationList());

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
    public function setParentId($id)
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
     * @param ConditionBlock $conditionBlock
     * @return $this|ShareConditionBuilderInterface
     */
    public function addConditionBlock(ConditionBlock $conditionBlock)
    {
        $this->conditionsBox->addChildConditionBlock(
            $conditionBlock
                ->setFieldsList($this->factory->getFieldsList())
                ->setOperationsList($this->factory->getOperationList())
        );

        return $this;
    }

    /**
     * @param ConditionsFieldsListInterface $conditionsList
     * @return $this
     */
    public function setFieldsList(ConditionsFieldsListInterface $conditionsList) //TODO maybe will be unused
    {
        $this->conditionsBox->setFieldsList($conditionsList);
        return $this;
    }

    /**
     * @param OperationList $operationsList
     */
    public function setOperationsList(OperationList $operationsList) //TODO maybe will be unused
    {
        $this->conditionsBox->setOperationsList($operationsList);
    }

    /**
     * @param $id
     * @param $valuesList
     */
    public function setValuesList($id, $valuesList) //TODO
    {
        //$this->getChildConditionBlock($id)->setValuesList($valuesList);
    }

    /**
     * @param $id
     * @return ConditionBlock|null
     */
    public function getChildConditionBlock($id)
    {
        return $this->conditionsBox->getChildConditionBlock($id);
    }

    /**
     * @return ConditionBlock
     */
    public function getConditionBlock()
    {
        return $this->conditionsBox;
    }
}
