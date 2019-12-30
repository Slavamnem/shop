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

class VariationGraphicResource extends AbstractGraphicResource implements GraphicResource
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getResourceItemLabel(GraphicResourceItem $resourceItem)
    {
        return $resourceItem->getLabel();
    }
}
