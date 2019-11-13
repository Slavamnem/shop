<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.11.2019
 * Time: 0:06
 */

namespace App\Components\ShareConditions\Delimiters;

use App\Components\ShareConditions\Interfaces\Delimiter;

class AndDelimiter implements Delimiter
{
    /**
     * @return string
     */
    public function getKey() : string
    {
        return 'and';
    }

    /**
     * @return string
     */
    public function getTitle() : string
    {
        return 'И';
    }

    /**
     * @return string
     */
    public function getColor() : string
    {
        return 'yellow';
    }

    /**
     * @return string
     */
    public function getAnnotation() : string
    {
        return 'Каждое условие из списка должо быть выполнено!';
    }
}
