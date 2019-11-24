<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 23:31
 */

namespace App\Components\ShareConditions\Interfaces;

interface ConditionBlock
{
    /**
     * @return mixed
     */
    public function getId();

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function setId($id) : ConditionBlock;

    /**
     * @return mixed
     */
    public function getPid();

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function setPid($id) : ConditionBlock;

    /**
     * @return ConditionStatus
     */
    public function getStatus() : ConditionStatus;

    /**
     * @param $value
     * @return mixed
     */
    public function setStatus($value);

    /**
     * @param ConditionStatus $value
     * @return ConditionBlock
     */
    public function changeStatus(ConditionStatus $value) : ConditionBlock;

    /**
     * @return mixed
     */
    public function getType();

    /**
     * @param $value
     * @return ConditionBlock
     */
    public function setType($value) : ConditionBlock;

    public function show();
}
