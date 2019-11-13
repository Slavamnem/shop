<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.11.2019
 * Time: 0:06
 */

namespace App\Components\ShareConditions\Delimiters;

use App\Components\ShareConditions\Interfaces\Delimiter;

class OrDelimiter implements Delimiter
{
    /**
     * @return string
     */
    public function getKey() : string
    {
        return 'or';
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return 'ИЛИ';
    }

    /**
     * @return string
     */
    public function getColor() : string
    {
        return 'blue';
    }

    /**
     * @return string
     */
    public function getAnnotation() : string
    {
        return 'Хотябы одно исловие из списка должно быть выполнено!';
    }
}
