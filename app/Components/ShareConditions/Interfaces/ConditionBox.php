<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 13.11.2019
 * Time: 0:05
 */

namespace App\Components\ShareConditions\Interfaces;

interface ConditionBox extends ConditionBlock //TODO condition interface
{
    /**
     * @return Delimiter
     */
    public function getDelimiter(): Delimiter;

    /**
     * @param Delimiter $delimiter
     * @return ConditionBox
     */
    public function setDelimiter(Delimiter $delimiter): ConditionBox;
}
