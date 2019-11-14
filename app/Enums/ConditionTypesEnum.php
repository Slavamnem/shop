<?php

namespace App\Enums;

use App\Components\ShareConditions\Factory\BaseShareConditionsFactory;
use App\Components\ShareConditions\Factory\FullShareConditionsFactory;
use App\Components\ShareConditions\Factory\TimeShareConditionsFactory;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;

class ConditionTypesEnum extends AbstractEnum //TODO разобраться в энамах общая страутура, статика или нет, как возвращать классы привязанные
{
    public const BASE = 'base';
    public const FULL = 'full';
    public const TIME = 'time';

    private $enums = [
        self::BASE => 'Базовый',
        self::FULL => 'Расширенный',
        self::TIME => 'Временный',
    ];

    private $enumsFactory = [
        self::BASE => BaseShareConditionsFactory::class,
        self::FULL => FullShareConditionsFactory::class,
        self::TIME => TimeShareConditionsFactory::class,
    ];

    /**
     * @return ShareConditionsFactory
     */
    public function getTypeFactory()
    {
        return new (array_get($this->enumsFactory, $this->getValue()));
    }

    /**
     * @param $type
     * @return ConditionTypesEnum
     */
    public static function CREATE($type)
    {
        return new self($type);
    }

    /**
     * @return ConditionTypesEnum
     */
    public static function BASE()
    {
        return new self(self::BASE);
    }

    /**
     * @return ConditionTypesEnum
     */
    public static function FULL()
    {
        return new self(self::FULL);
    }

    /**
     * @return ConditionTypesEnum
     */
    public static function TIME()
    {
        return new self(self::TIME);
    }
}
