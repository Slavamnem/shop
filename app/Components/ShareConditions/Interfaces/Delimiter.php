<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.11.2019
 * Time: 0:03
 */

namespace App\Components\ShareConditions\Interfaces;

interface Delimiter
{
    /**
     * @return string
     */
    public function getKey() : string;

    /**
     * @return string
     */
    public function getTitle() : string;

    /**
     * @return string
     */
    public function getColor() : string;

    /**
     * @return string
     */
    public function getAnnotation() : string;
}
