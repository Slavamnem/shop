<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:47
 */

namespace App\Components\ShareConditions\Conditions;

use App\Components\ShareConditions\ConditionBoxes\AbstractConditionBox;
use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionsFieldsListInterface;
use App\Components\ShareConditions\Interfaces\ConditionStatus;
use App\Components\ShareConditions\Interfaces\Delimiter;
use App\Components\ShareConditions\Interfaces\OperationList;
use App\Strategies\Conditions\ConditionStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

abstract class AbstractCondition implements ConditionBlock
{
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $parentId;
    /**
     * @var
     */
    protected $type; //TODO unused?
    /**
     * @var ConditionStatus
     */
    protected $status; //TODO
    /**
     * @var
     */
    protected $field;
    /**
     * @var string
     */
    protected $operation;
    /**
     * @var
     */
    private $currentValue;
    /**
     * @var StrategyInterface
     */
    protected $conditionsStrategy;
    /**
     * @var ConditionsFieldsListInterface
     */
    private $fieldsList;
    /**
     * @var OperationList
     */
    private $operationsList;

    /**
     * AbstractCondition constructor.
     */
    public function __construct()
    {
        $this->conditionsStrategy = new ConditionStrategy();
    }

    abstract function show();

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

    /*
     * @return mixed
     */
    public function getParentId()
    {
        return $this->parentId;
    }

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function setParentId($id)
    {
        $this->parentId = $id;
        return $this;
    }

    /**
     * @param ConditionStatus $status
     * @return ConditionBlock
     */
    public function changeStatus(ConditionStatus $status) : ConditionBlock
    {
        $this->status = $status;
        return $this;
    }

    /**
     * @return ConditionStatus
     */
    public function getStatus() : ConditionStatus
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     * @return ConditionBlock
     */
    public function setType($type) : ConditionBlock
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @param $value
     * @return ConditionBlock
     */
    public function setField($value) : ConditionBlock
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
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     * @return ConditionBlock
     */
    public function setOperation(string $operation): ConditionBlock
    {
        $this->operation = $operation;
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
     * @param $value
     * @return ConditionBlock
     */
    public function setCurrentValue($value) : ConditionBlock
    {
        $this->currentValue = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValuesList()
    {
        return $this->conditionsStrategy->getStrategy($this->getType())->getValues();
    }

    /**
     * @return ConditionsFieldsListInterface
     */
    public function getFieldsList(): ConditionsFieldsListInterface
    {
        return $this->fieldsList;
    }

    /**
     * @param ConditionsFieldsListInterface $fieldsList
     * @return ConditionBlock
     */
    public function setFieldsList(ConditionsFieldsListInterface $fieldsList): ConditionBlock
    {
        $this->fieldsList = $fieldsList;
        return $this;
    }

    /**
     * @return OperationList
     */
    public function getOperationsList(): OperationList
    {
        return $this->operationsList;
    }

    /**
     * @param OperationList $operationsList
     * @return ConditionBlock
     */
    public function setOperationsList(OperationList $operationsList): ConditionBlock
    {
        $this->operationsList = $operationsList;
        return $this;
    }

    /**
     * @return Delimiter|null
     */
    public function getDelimiter(): Delimiter{
        return null;
    }

    /**
     * @param Delimiter $delimiter
     * @return ConditionBlock
     */
    public function setDelimiter(Delimiter $delimiter): ConditionBlock
    {
        return $this;
    }

    ////////////

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getChildConditionBlocks() : Collection
    {
        return collect();
    }

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function getChildConditionBlock($id) : ConditionBlock
    {
        return $this;
    }

    /**
     * @param ConditionBlock $condition
     * @return $this|ConditionBlock
     */
    public function addChildConditionBlock(ConditionBlock $condition){
        return $this;
    }

    /**
     * @param $blockData
     * @return ConditionBlock
     */
    public function getChildBlockData($blockData) : ConditionBlock
    {
        return null;
    }
}
