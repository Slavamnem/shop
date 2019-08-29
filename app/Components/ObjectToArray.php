<?php

namespace App\Components;

class ObjectToArray
{
    /**
     * @param $obj
     * @return array
     */
    public static function make($obj)
    {
        return get_object_vars($obj);
    }
}
