<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:41
 */

namespace App\Components\Graphics\Resources;

use App\Components\Graphics\GraphicResource;
use App\Components\Graphics\GraphicResourceItem;
use Illuminate\Support\Collection;

class DayGraphicResource extends AbstractTimeGraphicResource implements GraphicResource
{
    const LAST_HOUR = 24;

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
        $this->resourceGrid = collect(array_fill(0, self::LAST_HOUR, 0));
    }
}
