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

class YearGraphicResourceSegregationSegregationTypeStrategy implements GraphicResourceSegregationTypeStrategyInterface
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return string
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return lang("months." . $resourceItem->getCreationDate()->format('F'));
    }

    /**
     * @param GraphicResource $graphicResource
     * @return mixed
     */
    public function createSegregationSkeleton(GraphicResource $graphicResource)
    {
        $resourceItems = collect();

        foreach (lang("months") as $key => $month) {
            $resourceItems->put($month, 0);
        }

        return $resourceItems;
    }
}
