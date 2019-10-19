<?php

namespace App\Enums;

use App\Components\Enum;

class ReportTypesEnum extends AbstractEnum
{
    public const YEAR = 1;
    public const MONTH = 2;
    public const DAY = 3;

    /**
     * @var array
     */
    protected $enums = [
        self::YEAR  => 'Годовой отчет',
        self::MONTH => 'Месячный отчет',
        self::DAY   => 'Дневной отчет',
    ];

    /**
     * @return ReportTypesEnum
     */
    public static function YEAR()
    {
        return new self(self::YEAR);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function MONTH()
    {
        return new self(self::MONTH);
    }

    /**
     * @return ReportTypesEnum
     */
    public static function DAY()
    {
        return new self(self::DAY);
    }
}