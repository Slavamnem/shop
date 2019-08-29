<?php

namespace App\Enums;

class PrioritiesEnum extends AbstractEnum
{
    public const HIGH = 1;
    public const MIDDLE = 2;
    public const LOW = 3;

    /**
     * @return PrioritiesEnum
     */
    public static function HIGH()
    {
        return new self(self::HIGH);
    }

    /**
     * @return PrioritiesEnum
     */
    public static function MIDDLE()
    {
        return new self(self::MIDDLE);
    }

    /**
     * @return PrioritiesEnum
     */
    public static function LOW()
    {
        return new self(self::LOW);
    }
}
