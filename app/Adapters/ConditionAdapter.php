<?php

namespace App\Adapters;

use App\Components\Condition;

class ConditionAdapter
{
    /**
     * @param $shareConditionData
     * @param $conditionDelimiter
     * @return Condition
     */
    public static function getFromShareConditionData($shareConditionData, $conditionDelimiter)
    {
        return (new Condition())
            ->setField(array_get($shareConditionData, 'field'))
            ->setOperation(array_get($shareConditionData, 'operation'))
            ->setCurrentValue(array_get($shareConditionData, 'value'))
            ->setDelimiter($conditionDelimiter);
    }
}