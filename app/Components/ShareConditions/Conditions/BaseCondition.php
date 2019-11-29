<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 23:48
 */

namespace App\Components\ShareConditions\Conditions;

use App\Components\ShareConditions\Interfaces\ConditionBlock;

class BaseCondition extends AbstractCondition implements ConditionBlock
{
    public function show()
    {
        return view('admin.shares.conditions.condition', ['condition' => $this]);//->render();
        //dump('Hi its BaseCondition' . ' My id is: ' . $this->getId());
    }
}
