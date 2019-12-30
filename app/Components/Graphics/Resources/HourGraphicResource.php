<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:41
 */

namespace App\Components\Graphics\Resources;

use App\Components\Graphics\Interfaces\GraphicResource;
use App\Components\Graphics\Interfaces\GraphicResourceItem;

class HourGraphicResource extends AbstractTimeGraphicResource implements GraphicResource
{
    const MINUTES_IN_HOUR = 60;

    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return $resourceItem->getCreationDate()->minute;
    }

    public function createGridSkeleton()
    {
        $this->resourceGrid = collect(array_fill(1, self::MINUTES_IN_HOUR, 0));
    }
}
