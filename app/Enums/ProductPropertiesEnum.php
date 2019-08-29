<?php

namespace App\Enums;

class ProductPropertiesEnum extends AbstractEnum
{
    public const WEIGHT = "Вес";

    protected $enums = [
        1 => self::WEIGHT
    ];

    /**
     * @return ProductPropertiesEnum
     */
    public static function NEW_WEIGHT()
    {
        return new self(self::WEIGHT);
    }
}
