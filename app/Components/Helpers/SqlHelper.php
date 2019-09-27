<?php

namespace App\Components\Helpers;

class SqlHelper
{
    /**
     * @param $query
     * @return mixed
     */
    public static function restoreSql($query)
    {
        foreach ($query->bindings as $binding) {
            $pos = strpos($query->sql, '?');
            $query->sql = substr_replace($query->sql, $binding, $pos, 1);
        }

        return $query->sql;
    }
}
