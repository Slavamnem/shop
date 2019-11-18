<?php

namespace App\Enums;

use App\Components\ShareConditions\Factory\BaseShareConditionsFactory;
use App\Components\ShareConditions\Factory\FullShareConditionsFactory;
use App\Components\ShareConditions\Factory\TimeShareConditionsFactory;
use App\Components\ShareConditions\Interfaces\ShareConditionsFactory;

class ConditionTypesEnum extends AbstractEnum //TODO разобраться в енамах общая структура, статика или нет, как возвращать классы привязанные
{
    public const BASE = 1;
    public const FULL = 2;
    public const TIME = 3;

    /**
     * @var array
     */
    protected $enums = [
        self::BASE => 'Базовый',
        self::FULL => 'Расширенный',
        self::TIME => 'Временный',
    ];

    /**
     * @var array
     */
    protected $enumsFactory = [
        self::BASE => BaseShareConditionsFactory::class,
        self::FULL => FullShareConditionsFactory::class,
        self::TIME => TimeShareConditionsFactory::class,
    ];

    /**
     * @return ShareConditionsFactory
     */
    public function getTypeFactory()
    {
        $factoryClass = array_get($this->enumsFactory, $this->getValue());
        return new $factoryClass;
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
