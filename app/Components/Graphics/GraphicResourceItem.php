<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:00
 */

namespace App\Components\Graphics;

interface GraphicResourceItem
{
    /**
     * @return array
     */
    public function getLabel();

    /**
     * @return array
     */
    public function getValue();
}
