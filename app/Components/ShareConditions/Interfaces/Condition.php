<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:05
 */

namespace App\Components\ShareConditions\Interfaces;

interface Condition
{
    /**
     * @param int $value
     * @return $this
     */
    public function setId($value);

    /**
     * @return int
     */
    public function getId() : int;

    /**
     * @return string
     */
    public function getField();

    /**
     * @return array
     */
    public function getOperations() : array;
}
