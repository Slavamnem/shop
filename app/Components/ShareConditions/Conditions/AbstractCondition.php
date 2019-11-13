<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:47
 */

namespace App\Components\ShareConditions\Conditions;

use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionStatus;
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
    protected $type;
    /**
     * @var ConditionStatus
     */
    protected $status;
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

    /**
     * @param ConditionStatus $status
     * @return $this
     */
    public function changeStatus(ConditionStatus $status)
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
     * @return AbstractCondition
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
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
     * @return string
     */
    public function getOperation(): string
    {
        return $this->operation;
    }

    /**
     * @param string $operation
     * @return AbstractCondition
     */
    public function setOperation(string $operation): AbstractCondition
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
    public function getValuesList()
    {
        return $this->conditionsStrategy->getStrategy($this->getType())->getValues();
    }

    ////////////

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getConditionBlocks() : Collection
    {
        return collect();
    }

    /**
     * @param ConditionBlock $condition
     */
    public function addConditionBlock(ConditionBlock $condition){}

    /**
     * @param $id
     * @return ConditionBlock|null
     */
    public function getConditionBlock($id) : ConditionBlock
    {
        return null;
    }
}
