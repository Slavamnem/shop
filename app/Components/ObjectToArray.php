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
        $resultArray = [];

        foreach (get_object_vars($obj) as $attribute) {
            $resultArray[$attribute] = $obj->$attribute;
        }

        return $resultArray;
    }
}
