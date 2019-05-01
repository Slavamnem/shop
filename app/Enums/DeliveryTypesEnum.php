<?php

namespace App\Enums;

use App\Components\Enum;

class DeliveryTypesEnum extends Enum
{
    public const NOVA_POSHTA = 1;
    public const SELF = 2;

    public static function getValues()
    {
        return [
            1 => "Новая Почта",
            2 => "Самовывоз",
        ];
    }
}