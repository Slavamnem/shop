<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:05
 */

namespace App\Components\ShareConditions\Interfaces;

use Illuminate\Support\Collection;

interface ConditionBox extends ConditionBlock
{
    /**
     * @return Delimiter
     */
    public function getDelimiter(): Delimiter;

    /**
     * @param Delimiter $delimiter
     * @return ConditionBox
     */
    public function setDelimiter(Delimiter $delimiter): ConditionBox;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getChildren() : Collection;

    /**
     * @param ConditionBlock $conditionBlock
     */
    public function addChild(ConditionBlock $conditionBlock);

    /**
     * @param $id
     * @return ConditionBlock
     */
    public function getChildById($id) : ConditionBlock;
}
