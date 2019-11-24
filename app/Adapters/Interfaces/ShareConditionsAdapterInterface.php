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
use App\Share;

interface ShareConditionsAdapterInterface
{
    /**
     * @return mixed
     */
    public function createConditionBox();

    /**
     * @param $conditionBlockData
     * @return ConditionBlock|Condition|ConditionBox
     */
    public function createConditionBlockFromData($conditionBlockData);
}
