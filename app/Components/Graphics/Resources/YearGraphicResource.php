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

class YearGraphicResource extends AbstractGraphicResource implements GraphicResource
{
    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    public function getItemLabel(GraphicResourceItem $resourceItem)
    {
        return lang("months." . $resourceItem->getCreationDate()->format('F'));
    }
}
