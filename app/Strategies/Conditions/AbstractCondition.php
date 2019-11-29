<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.11.2019
 * Time: 0:09
 */

namespace App\Strategies\Conditions;

use Illuminate\Support\Collection;

abstract class AbstractCondition
{
    /**
     * @var Collection
     */
    protected $values;
    /**
     * @var AbstractCondition
     */
    protected static $instance;

    /**
     * @return AbstractCondition
     */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }

    /**
     * @param null $type
     * @return Collection
     */
    abstract public function getValues($type = null);
}
