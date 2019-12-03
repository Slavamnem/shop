<?php

namespace App\Enums;

class GraphicSegregationTypesEnum extends AbstractEnum
{
    public const YEAR = 1;
    public const MONTH = 2;
    public const DAY = 3;
    public const HOUR = 4;

    /**
     * @var array
     */
    protected $enums = [
        self::YEAR      => 'year',
        self::MONTH     => 'month',
        self::DAY       => 'day',
        self::HOUR      => 'hour',
    ];

    /**
     * @return GraphicSegregationTypesEnum
     */
    public static function YEAR()
    {
        return new self(self::YEAR);
    }

    /**
     * @return GraphicSegregationTypesEnum
     */
    public static function MONTH()
    {
        return new self(self::MONTH);
    }

    /**
     * @return GraphicSegregationTypesEnum
     */
    public static function DAY()
    {
        return new self(self::DAY);
    }

    /**
     * @return GraphicSegregationTypesEnum
     */
    public static function HOUR()
    {
        return new self(self::HOUR);
    }
}
