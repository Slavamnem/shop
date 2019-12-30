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

class DayGraphicResource extends AbstractTimeGraphicResource implements GraphicResource
{
    const DAY_HOURS_AMOUNT = 24;

    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return $resourceItem->getCreationDate()->hour;
    }

    public function createGridSkeleton()
    {
        $this->resourceGrid = collect(array_fill(0, self::DAY_HOURS_AMOUNT, 0));
    }
}
