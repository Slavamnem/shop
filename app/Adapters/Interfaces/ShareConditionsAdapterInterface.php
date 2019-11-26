<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.11.2019
 * Time: 0:00
 */

namespace App\Adapters\Interfaces;

use App\Components\ShareConditions\Interfaces\Condition;
use App\Components\ShareConditions\Interfaces\ConditionBlock;
use App\Components\ShareConditions\Interfaces\ConditionBox;

interface ShareConditionsAdapterInterface
{
    /**
     * @return ConditionBlock
     */
    public function createMainBox();

    /**
     * @param $conditionBlockData
     * @return ConditionBlock|Condition|ConditionBox
     */
    public function createConditionBlock($conditionBlockData);

    /**
     * @return mixed
     */
    public function getMainBlockChildren();

    /**
     * @param array $conditionBoxData
     * @return \Illuminate\Support\Collection
     */
    public function getConditionBlockChildren($conditionBoxData);
}
