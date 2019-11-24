<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:47
 */

namespace App\Components\ShareConditions\Conditions;

use App\Components\ShareConditions\AbstractConditionBlock;
use App\Components\ShareConditions\Interfaces\Condition;
use App\Components\ShareConditions\Interfaces\ConditionsFieldsListInterface;
use App\Components\ShareConditions\Interfaces\OperationsList;
use App\Strategies\Conditions\ConditionStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

abstract class AbstractCondition extends AbstractConditionBlock implements Condition
{
    /**
     * @var
     */
    protected $field;
    /**
     * @var string
     */
    protected $operationId;
    /**
     * @var
     */
    private $value;
    /**
     * @var StrategyInterface
     */
    protected $conditionsStrategy;
    /**
     * @var ConditionsFieldsListInterface
     */
    private $fieldsList;
    /**
     * @var OperationsList
     */
    private $operationsList;

    /**
     * AbstractCondition constructor.
     */
    public function __construct()
    {
        $this->conditionsStrategy = new ConditionStrategy();//TODO di
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
     * @return Condition
     */
    public function setField($value) : Condition
    {
        $this->field = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function getOperationId(): string
    {
        return $this->operationId;
    }

    /**
     * @param $id
     * @return Condition
     */
    public function setOperationId($id): Condition
    {
        $this->operationId = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @return Condition
     */
    public function setValue($value) : Condition
    {
        $this->value = $value;
        return $this;
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
     * @return Condition
     */
    public function setFieldsList(ConditionsFieldsListInterface $fieldsList): Condition
    {
        $this->fieldsList = $fieldsList;
        return $this;
    }

    /**
     * @return OperationsList
     */
    public function getOperationsList(): OperationsList
    {
        return $this->operationsList;
    }

    /**
     * @param OperationsList $operationsList
     * @return Condition
     */
    public function setOperationsList(OperationsList $operationsList): Condition
    {
        $this->operationsList = $operationsList;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getValuesList() : Collection
    {
        return $this->conditionsStrategy->getStrategy($this->getType())->getValues();
    }
}
