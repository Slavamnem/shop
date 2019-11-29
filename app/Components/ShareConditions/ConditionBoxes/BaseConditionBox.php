<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.11.2019
 * Time: 0:46
 */

namespace App\Components\ShareConditions\ConditionBoxes;

use App\Components\ShareConditions\Interfaces\ConditionBlock;

class BaseConditionBox extends AbstractConditionBox implements ConditionBlock
{
    public function show()
    {
        return view('admin.shares.conditions.box', ['box' => $this]);//->render();
    }
}
