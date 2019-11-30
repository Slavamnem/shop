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
     * @return array|int
     */
    public function getYearLabel();

    /**
     * @return array|int
     */
    public function getMonthLabel();

    /**
     * @return null|string
     */
    public function getVariationLabel();

    /**
     * @return array|float
     */
    public function getValue();
}
