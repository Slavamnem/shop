<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 1:01
 */

namespace App\Strategies\Graphics\GraphicResource\Strategies;

use App\Components\GraphicsInterfaces\GraphicResource;
use App\Components\Graphics\Interfaces\GraphicResourceItem;
use App\Strategies\Interfaces\GraphicResourceSegregationTypeStrategyInterface;

class DayGraphicResourceSegregationSegregationTypeStrategy implements GraphicResourceSegregationTypeStrategyInterface
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return string
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return $resourceItem->getCreationDate()->hour;
    }

    /**
     * @param GraphicResource $graphicResource
     * @return \Illuminate\Support\Collection|mixed
     */
    public function createSegregationSkeleton(GraphicResource $graphicResource)
    {
        $resourceItems = collect();

        foreach (range(0, 23) as $hour) {
            $resourceItems->put($hour, 0);
        }

        return $resourceItems;
    }
}
