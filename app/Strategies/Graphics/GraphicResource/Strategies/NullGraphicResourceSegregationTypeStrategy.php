<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 1:01
 */

namespace App\Strategies\Graphics\GraphicResource\Strategies;

use App\Components\Graphics\GraphicResourceItem;
use App\Strategies\Interfaces\GraphicResourceTypeStrategyInterface;

class NullGraphicResourceSegregationTypeStrategy implements GraphicResourceTypeStrategyInterface
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return string
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return "Undefined resource type";
    }
}
