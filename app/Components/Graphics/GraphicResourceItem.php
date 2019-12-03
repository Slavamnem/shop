<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:00
 */

namespace App\Components\Graphics;

use Carbon\Carbon;

interface GraphicResourceItem
{
    /**
     * @return string
     */
    public function getLabel() : string;

    /**
     * @param null $itemQualifierClosure
     * @return GraphicResourceItem
     */
    public function setLabel($itemQualifierClosure = null) : GraphicResourceItem;

    /**
     * @return array|float
     */
    public function getValue() : string;

    /**
     * @param int $itemValueClosure
     * @return GraphicResourceItem
     */
    public function setValue($itemValueClosure = 1) : GraphicResourceItem;

    /**
     * @return Carbon
     */
    public function getCreationDate() : Carbon;
}
