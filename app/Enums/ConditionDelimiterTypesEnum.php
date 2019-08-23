<?php

namespace App\Enums;

use App\Components\Enum;
use App\Components\Order\Delivery\JustinDelivery;
use App\Components\Order\Delivery\NovaPoshtaDelivery;
use App\Components\Order\Delivery\PickUpDelivery;

class ConditionDelimiterTypesEnum extends Enum
{
    public const OR = "or";
    public const AND = "and";

    public const ENUM_TRANSLATIONS = [
        self::OR => "ИЛИ",
        self::AND => "И"
    ];

    /**
     * @param $delimiterType
     * @return mixed
     */
    public static function getTranslation($delimiterType)
    {
        return @self::ENUM_TRANSLATIONS[$delimiterType];
    }
}