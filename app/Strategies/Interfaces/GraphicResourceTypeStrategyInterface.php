<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 1:00
 */

namespace App\Strategies\Interfaces;

use App\Components\Graphics\GraphicResourceItem;

interface GraphicResourceTypeStrategyInterface
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return string
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem);
}
