<?php

namespace App\Enums;

class ReportPeriodTypesEnum extends AbstractEnum
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
     * @param $id
     * @return ReportPeriodTypesEnum
     */
    public static function CREATE($id)
    {
        return new self($id);
    }

    /**
     * @return ReportPeriodTypesEnum
     */
    public static function YEAR()
    {
        return new self(self::YEAR);
    }

    /**
     * @return ReportPeriodTypesEnum
     */
    public static function MONTH()
    {
        return new self(self::MONTH);
    }

    /**
     * @return ReportPeriodTypesEnum
     */
    public static function DAY()
    {
        return new self(self::DAY);
    }
}