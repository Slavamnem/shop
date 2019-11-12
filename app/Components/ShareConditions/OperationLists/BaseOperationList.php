<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:27
 */

namespace App\Components\ShareConditions\OperationLists;

use App\Components\ShareConditions\Interfaces\OperationList;
use App\ConditionOperation;

class BaseOperationList implements OperationList
{
    /**
     * @return array
     */
    public function getList(): array
    {
        return ConditionOperation::query()
            ->where('extra', 0)
            ->get()
            ->pluck('name')
            ->toArray();
    }
}
