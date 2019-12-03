<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 1:01
 */

namespace App\Strategies\Graphics\GraphicResource\Strategies;

use App\Components\Graphics\GraphicResource;
use App\Components\Graphics\GraphicResourceItem;
use App\Strategies\Interfaces\GraphicResourceSegregationTypeStrategyInterface;

class HourGraphicResourceSegregationSegregationTypeStrategy implements GraphicResourceSegregationTypeStrategyInterface
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return string
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return $resourceItem->getCreationDate()->minute;
    }

    /**
     * @param GraphicResource $graphicResource
     * @return mixed|void
     */
    public function createSegregationSkeleton(GraphicResource $graphicResource)
    {

    }
}
