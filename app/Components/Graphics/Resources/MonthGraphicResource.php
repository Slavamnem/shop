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

class MonthGraphicResource extends AbstractTimeGraphicResource implements GraphicResource
{
    const MAX_MONTH_DAYS_AMOUNT = 31;

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
        $this->resourceGrid = collect(array_fill(1, self::MAX_MONTH_DAYS_AMOUNT, 0)); //TODO
    }
}
