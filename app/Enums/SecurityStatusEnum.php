<?php

namespace App\Enums;

class SecurityStatusEnum extends AbstractEnum
{
    public const SAFE = 1;
    public const UNDEFINED = 2;
    public const NOTICE = 3;
    public const DANGER = 4;
    public const ATTACK = 5;

    /**
     * @return SecurityStatusEnum
     */
    public static function SAFE()
    {
        return new self(self::SAFE);
    }

    /**
     * @return SecurityStatusEnum
     */
    public static function UNDEFINED()
    {
        return new self(self::UNDEFINED);
    }

    /**
     * @return SecurityStatusEnum
     */
    public static function NOTICE()
    {
        return new self(self::NOTICE);
    }

    /**
     * @return SecurityStatusEnum
     */
    public static function DANGER()
    {
        return new self(self::DANGER);
    }

    /**
     * @return SecurityStatusEnum
     */
    public static function ATTACK()
    {
        return new self(self::ATTACK);
    }
}
