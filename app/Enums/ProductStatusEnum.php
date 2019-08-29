<?php

namespace App\Enums;

class ProductStatusEnum extends AbstractEnum
{
    public const AVAILABLE = 1;
    public const NOT_AVAILABLE = 2;
    public const SOON_AVAILABLE = 3;

    /**
     * @return ProductStatusEnum
     */
    public static function AVAILABLE()
    {
        return new self(self::AVAILABLE);
    }

    /**
     * @return ProductStatusEnum
     */
    public static function NOT_AVAILABLE()
    {
        return new self(self::NOT_AVAILABLE);
    }

    /**
     * @return ProductStatusEnum
     */
    public static function SOON_AVAILABLE()
    {
        return new self(self::SOON_AVAILABLE);
    }
}