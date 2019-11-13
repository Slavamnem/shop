<?php

namespace App\Enums;

use App\Components\Enum;
use App\Components\Order\Delivery\JustinDelivery;
use App\Components\Order\Delivery\NovaPoshtaDelivery;
use App\Components\Order\Delivery\PickUpDelivery;
use App\Components\ShareConditions\Delimiters\AndDelimiter;
use App\Components\ShareConditions\Delimiters\OrDelimiter;

class ConditionDelimiterTypesEnum extends AbstractEnum
{
    public const OR = "or";
    public const AND = "and";

    public const ENUM_TRANSLATIONS = [
        self::OR => "ИЛИ",
        self::AND => "И"
    ];

    public const ENUM_CLASSES = [
        self::OR => OrDelimiter::class,
        self::AND => AndDelimiter::class
    ];

    /**
     * @param $delimiterType
     * @return mixed
     */
    public static function getTranslation($delimiterType)
    {
        return @self::ENUM_TRANSLATIONS[$delimiterType];
    }

    /**
     * @param $key
     * @return mixed
     */
    public static function getClass($key)
    {
        return new (self::ENUM_CLASSES[$key]);
    }
}