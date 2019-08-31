<?php

if (!function_exists('lang')) {
    function lang($key)
    {
        return \Illuminate\Support\Facades\Lang::get($key);
    }
}

if (!function_exists('array_init')) {
    function array_init($value = 0, $length = 10)
    {
        $resultArray = array();

        for ($i = 0; $i < $length; $i++) {
            $resultArray[$i] = $value;
        }
        return $resultArray;
    }
}

if (!function_exists('element')) {
    function element($key)
    {
        if ($element = \App\SiteElement::where('key', $key)->first()) {
            return $element->value;
        }
    }
}
