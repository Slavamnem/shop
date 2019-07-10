<?php

namespace App\Enums;

use App\Components\Enum;
use App\Components\Order\Payment\CashOnDeliveryPayment;
use App\Components\Order\Payment\CashPayment;
use App\Components\Order\Payment\LickPayPayment;

class PaymentTypesEnum extends Enum
{
    public const LIQ_PAY = 1;
    public const CASH = 2;
    public const CASH_ON_DELIVERY = 3;

    public const PAYMENT_TYPES = [
        self::LIQ_PAY          => LickPayPayment::class,
        self::CASH             => CashPayment::class,
        self::CASH_ON_DELIVERY => CashOnDeliveryPayment::class
    ];

    public static function getValues()
    {
        return [
            1 => "Оплата картой онлайн",
            2 => "Оплата наличными",
            3 => "Наложенный платеж",
        ];
    }

    /**
     * @param $paymentType
     * @return mixed
     */
    public static function getPayment($paymentType)
    {
        $paymentClassName = self::PAYMENT_TYPES[$paymentType];
        return new $paymentClassName();
    }
}