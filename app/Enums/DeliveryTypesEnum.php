<?php

namespace App\Enums;

use App\Components\Enum;
use App\Components\Order\Delivery\NovaPoshtaDelivery;

class DeliveryTypesEnum extends Enum
{
    public const NOVA_POSHTA = 1;
    public const JUSTIN = 2;
    public const SELF = 3;

    public const DELIVERY_TYPES = [
        self::NOVA_POSHTA => NovaPoshtaDelivery::class,
    ];

    public static function getValues()
    {
        return [
            1 => "Новая Почта",
            2 => "Justin",
            3 => "Самовывоз",
        ];
    }

    /**
     * @param $deliveryType
     * @return mixed
     */
    public static function getDelivery($deliveryType)
    {
        $deliveryClassName = self::DELIVERY_TYPES[$deliveryType];
        return new $deliveryClassName();
    }
}