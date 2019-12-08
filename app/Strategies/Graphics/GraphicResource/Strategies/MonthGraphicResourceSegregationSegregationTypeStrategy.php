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

class MonthGraphicResourceSegregationSegregationTypeStrategy implements GraphicResourceSegregationTypeStrategyInterface
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return string
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return $resourceItem->getCreationDate()->day;
    }

    /**
     * @param GraphicResource $graphicResource
     * @return \Illuminate\Support\Collection|mixed
     */
    public function createSegregationSkeleton(GraphicResource $graphicResource)
    {
        $resourceItems = collect();

        foreach (range(1, 31) as $day) {
            $resourceItems->put($day, 0);
        }

        return $resourceItems;
    }
}
