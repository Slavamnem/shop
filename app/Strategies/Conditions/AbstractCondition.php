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
     * @var IdCondition
     */
    protected static $instance;

    /**
     * @return IdCondition
     */
    public static function Instance()
    {
        if (!self::$instance) {
            self::$instance = (new static())->setValues();
        }

        return self::$instance;
    }

    /**
     * @return Collection
     */
    public function getValues()
    {
        return $this->values;
    }

    /**
     * @return $this
     */
    abstract protected function setValues();
}