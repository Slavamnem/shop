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
        dump("_________________Hi, I'am BaseConditionBox. My id is: " . $this->getId() . " Start:___________________");

        foreach ($this->getChildren() as $child) {
            $child->show();
        }

        dump('________________End________________');

        //return "Hi, I'am BaseConditionBox";
    }
}
