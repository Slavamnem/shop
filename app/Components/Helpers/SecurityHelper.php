<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 25.09.2019
 * Time: 1:09
 */

namespace App\Components\Helpers;

class SecurityHelper
{
    /**
     * @var array
     */
    private static $blackList = [
        'SELECT', 'INSERT', 'UPDATE', 'DROP', 'TRUNCATE', '/', '?', '<', '>', '(', ')'
    ];

    /**
     * @param $value
     * @return bool
     */
    public static function hasForbiddenSymbols($value)
    {
        foreach (self::$blackList as $blackListItem) {
            if (strpos($value, $blackListItem) !== false) {
                return true;
            }
        }
        return false;
    }
}
