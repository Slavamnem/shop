<?php

namespace App\Enums;

class OrderStatusEnum extends AbstractEnum
{
    public const WAIT_FOR_PAYMENT = 1;
    public const PAID = 2;
    public const CANCELED = 3;

    public $enumsCssClasses = [
        self::WAIT_FOR_PAYMENT => "alert-warning",
        self::PAID             => "alert-success",
        self::CANCELED         => "alert-danger"
    ];

    /**
     * @param $statusId
     * @return mixed
     */
    public function getStatusClass($statusId = null)
    {
        return @array_get($this->enumsCssClasses, $statusId ?? $this->getValue());
    }

    /**
     * @return OrderStatusEnum
     */
    public static function WAIT_FOR_PAYMENT()
    {
        return new self(self::WAIT_FOR_PAYMENT);
    }

    /**
     * @return OrderStatusEnum
     */
    public static function PAID()
    {
        return new self(self::PAID);
    }

    /**
     * @return OrderStatusEnum
     */
    public static function CANCELED()
    {
        return new self(self::CANCELED);
    }
}
