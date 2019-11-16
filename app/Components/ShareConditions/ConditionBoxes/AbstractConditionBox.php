<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 23:49
 */

namespace App\Components\ShareConditions\ConditionBoxes;

use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBox;
use App\Components\ShareConditions\Interfaces\ConditionsFieldsListInterface;
use App\Components\ShareConditions\Interfaces\Delimiter;
use App\Components\ShareConditions\Interfaces\OperationList;
use Illuminate\Support\Collection;

abstract class AbstractConditionBox implements ConditionBlock
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
     * @var Collection
     */
    private $conditionBlocks;
    /**
     * @var Delimiter
     */
    private $delimiter;
    /**
     * @var ConditionsFieldsListInterface
     */
    private $fieldsList;
    /**
     * @var OperationList
     */
    private $operationsList;

    /**
     * AbstractConditionBox constructor.
     */
    public function __construct()
    {
        $this->conditionBlocks = collect();
    }

    abstract function show();

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return AbstractConditionBox
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
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
     * @return \Illuminate\Support\Collection
     */
    public function getChildConditionBlocks() : Collection
    {
        return $this->conditionBlocks;
    }

    /**
     * @param ConditionBlock $condition
     */
    public function addChildConditionBlock(ConditionBlock $condition)
    {
        $this->conditionBlocks->put($condition->getId(), $condition);
    }

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function getChildConditionBlock($id) : ConditionBlock
    {
        return $this->conditionBlocks->get($id);
    }

    /**
     * @return Delimiter
     */
    public function getDelimiter(): Delimiter
    {
        return $this->delimiter;
    }

    /**
     * @param Delimiter $delimiter
     * @return ConditionBlock
     */
    public function setDelimiter(Delimiter $delimiter): ConditionBlock
    {
        $this->delimiter = $delimiter;
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
     * @return AbstractConditionBox
     */
    public function setFieldsList(ConditionsFieldsListInterface $fieldsList): AbstractConditionBox
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
    }
}
