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

class MonthGraphicResource extends AbstractTimeGraphicResource implements GraphicResource
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return $resourceItem->getCreationDate()->day;
    }

    public function createGridSkeleton()
    {
        $this->resourceGrid = collect(array_fill(1, 31, 0));
    }
}
