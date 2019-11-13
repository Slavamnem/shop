<?php

namespace App\Enums;

use App\Components\ShareConditions\ConditionTypes\IdConditionType;
use App\Strategies\Conditions\PropertyConditionType;

class ConditionTypesEnum extends AbstractEnum
{
    public const ID = 'id';

    public $enums = [
        self::ID => IdConditionType::class
    ];

    /**
     * @param $type
     * @return mixed
     */
    public function getTypeClass($type)
    {
        return new (array_get($this->enums, $type))($type);
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
