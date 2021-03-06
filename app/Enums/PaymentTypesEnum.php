<?php

namespace App\Enums;

use App\Components\Enum;
use App\Strategies\Payment\Strategies\CashOnDeliveryPayment;
use App\Strategies\Payment\Strategies\CashPayment;
use App\Strategies\Payment\Strategies\LickPayPayment;

class PaymentTypesEnum extends AbstractEnum
{
    public const LIQ_PAY = 1;
    public const CASH = 2;
    public const CASH_ON_DELIVERY = 3;

    public const PAYMENT_TYPES = [
        self::LIQ_PAY          => LickPayPayment::class,
        self::CASH             => CashPayment::class,
        self::CASH_ON_DELIVERY => CashOnDeliveryPayment::class
    ];

    protected $enums = [
        self::LIQ_PAY          => "Оплата картой онлайн",
        self::CASH             => "Оплата наличными",
        self::CASH_ON_DELIVERY => "Наложенный платеж"
    ];

    /**
     * @return array
     */
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

    /**
     * @return PaymentTypesEnum
     */
    public static function LIQ_PAY()
    {
        return new self(self::LIQ_PAY);
    }

    /**
     * @return PaymentTypesEnum
     */
    public static function CASH()
    {
        return new self(self::CASH);
    }

    /**
     * @return PaymentTypesEnum
     */
    public static function CASH_ON_DELIVERY()
    {
        return new self(self::CASH_ON_DELIVERY);
    }
}
