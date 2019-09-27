<?php

namespace App\Enums;

class UserActionsEnum extends AbstractEnum
{
    public const DELETE_RECORD = 'delete_record';
    public const LOGIN_FAIL = 'login_fail';

    /**
     * @return UserActionsEnum
     */
    public static function DELETE_RECORD()
    {
        return new self(self::DELETE_RECORD);
    }

    /**
     * @return UserActionsEnum
     */
    public static function LOGIN_FAIL()
    {
        return new self(self::LOGIN_FAIL);
    }
}
