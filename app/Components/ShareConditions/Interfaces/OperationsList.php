<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:05
 */

namespace App\Components\ShareConditions\Interfaces;

use App\Components\ShareConditions\OperationLists\BaseOperationsList;

interface OperationsList
{
    /**
     * @return BaseOperationsList
     */
    public static function getInstance();

    /**
     * @return array
     */
    public function getList() :array;
}
