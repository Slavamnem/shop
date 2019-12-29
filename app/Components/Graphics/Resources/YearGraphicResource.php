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

class YearGraphicResource extends AbstractTimeGraphicResource implements GraphicResource
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return lang("months." . $resourceItem->getCreationDate()->format('F'));
    }

    public function createGridSkeleton()
    {
        $this->resourceGrid = collect();

        foreach (lang("months") as $key => $month) {
            $this->resourceGrid->put($month, 0);
        }
    }
}
