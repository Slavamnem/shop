<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 23:31
 */

namespace App\Components\ShareConditions\Interfaces;

use Illuminate\Support\Collection;

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
    public function setId($id);

    /**
     * @param ConditionBlock $conditionBlock
     * @return ConditionBlock
     */
    public function addConditionBlock(ConditionBlock $conditionBlock);

    /**
     * @param $id
     * @return ConditionBlock|null
     */
    public function getConditionBlock($id) : ConditionBlock;

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getConditionBlocks() : Collection;

    public function show();
}
