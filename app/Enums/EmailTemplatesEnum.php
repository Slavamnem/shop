<?php

namespace App\Enums;

class EmailTemplatesEnum extends AbstractEnum
{
    public const TEST = 1;
    public const ORDER_CREATED = 2;

    /**
     * @return EmailTemplatesEnum
     */
    public static function TEST()
    {
        return new self(self::TEST);
    }

    /**
     * @return EmailTemplatesEnum
     */
    public static function ORDER_CREATED()
    {
        return new self(self::ORDER_CREATED);
    }
}