<?php

namespace App\Enums;

use App\Components\Enum;

class PaymentTypesEnum extends Enum
{
    public const CARD_ONLINE = 1;
    public const CASH = 2;

    public static function getValues()
    {
        return [
            1 => "Оплата картой онлайн",
            2 => "Оплата наличными"
        ];
    }
}