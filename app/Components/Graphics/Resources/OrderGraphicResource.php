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

class OrderGraphicResource implements GraphicResource
{
    /**
     * @var Collection
     */
    private $resourceItems;

    /**
     * OrderGraphicResource constructor.
     * @param Collection $unfilteredItems
     */
    public function __construct(Collection $unfilteredItems)
    {
        $this->setResourceItems($unfilteredItems);
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return $this->resourceItems->keys()->all();
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->resourceItems->values()->all();
    }

    /**
     * @param Collection $unfilteredItems
     */
    private function setResourceItems(Collection $unfilteredItems)
    {
        $this->resourceItems = collect();

        foreach ($unfilteredItems as $resourceItem) {
            $this->incrementItem($resourceItem->getLabel(), $resourceItem);
        }
    }

    /**
     * @param $key
     * @param GraphicResourceItem $resourceItem
     */
    private function incrementItem($key, GraphicResourceItem $resourceItem)
    {
        $this->resourceItems->put($key, $this->resourceItems->get($key) + $resourceItem->getValue());
    }
}
