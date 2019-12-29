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
     * @param null $itemsLabelDistributorClosure
     * @return GraphicResourceItem
     */
    public function setLabel($itemsLabelDistributorClosure = null);

    /**
     * @return array|float
     */
    public function getValue() : string;

    /**
     * @param null $itemsValueQualifierClosure
     * @return GraphicResourceItem
     */
    public function setValue($itemsValueQualifierClosure = null);

    /**
     * @return Carbon
     */
    public function getCreationDate() : Carbon;
}
