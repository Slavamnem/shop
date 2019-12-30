<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 1:00
 */

namespace App\Strategies\Interfaces;

use App\Components\GraphicsInterfaces\GraphicResource;
use App\Components\Graphics\Interfaces\GraphicResourceItem;

interface GraphicResourceSegregationTypeStrategyInterface
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return string
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem);

    /**
     * @param GraphicResource $graphicResource
     * @return mixed
     */
    public function createSegregationSkeleton(GraphicResource $graphicResource);
}
