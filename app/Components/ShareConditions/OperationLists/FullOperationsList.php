<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:27
 */

namespace App\Components\ShareConditions\OperationLists;

use App\Components\ShareConditions\Interfaces\OperationsList;
use App\ConditionOperation;

class FullOperationsList implements OperationsList
{
    /*
     * array
     */
    private $list;
    /**
     * @var BaseOperationsList
     */
    private static $instance;

    /**
     * @return BaseOperationsList
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    /**
     * @return array
     */
    public function getList() : array
    {
        if (empty($this->list)) {
            $this->list = ConditionOperation::query()
                ->get()
                ->pluck('name')
                ->toArray();
        }

        return $this->list;
    }
}
