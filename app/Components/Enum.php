<?php

namespace App\Components;

class Enum
{
    public static function getValues()
    {
        $refl = new \ReflectionClass(static::class);
        return $refl->getConstants();
    }
}