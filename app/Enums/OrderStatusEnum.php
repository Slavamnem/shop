<?php

namespace App\Enums;

class OrderStatusEnum
{
    public const WAIT_FOR_PAYMENT = 1;
    public const PAID = 2;
    public const CANCELED = 3;
}