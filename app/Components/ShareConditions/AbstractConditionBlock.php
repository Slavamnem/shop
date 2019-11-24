<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 23.11.2019
 * Time: 15:41
 */

namespace App\Components\ShareConditions;

use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionStatus;

abstract class AbstractConditionBlock implements ConditionBlock
{
    /**
     * @var
     */
    protected $id;
    /**
     * @var
     */
    protected $pid;
    /**
     * @var
     */
    protected $type; //TODO unused?
    /**
     * @var ConditionStatus
     */
    protected $status; //TODO

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function setId($id) : ConditionBlock
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPid()
    {
        return $this->pid;
    }

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function setPid($id) : ConditionBlock
    {
        $this->pid = $id;
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
     * @param $value
     * @return ConditionBlock
     */
    public function setStatus($value) : ConditionBlock
    {
        $this->status = $value;
        return $this;
    }

    /**
     * @param ConditionStatus $value
     * @return ConditionBlock
     */
    public function changeStatus(ConditionStatus $value) : ConditionBlock
    {
        $this->status = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param $value
     * @return ConditionBlock
     */
    public function setType($value) : ConditionBlock
    {
        $this->type = $value;
        return $this;
    }

    abstract public function show();
}
