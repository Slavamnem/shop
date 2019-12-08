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

abstract class AbstractGraphicResource implements GraphicResource
{
    /**
     * @var Collection
     */
    protected $resourceItems;
    /**
     * @var string
     */
    protected $segregationType;

    /**
     * @param Collection $resourceItems
     * @return GraphicResource
     */
    public function setResourceItems(Collection $resourceItems)
    {
        $this->resourceItems = collect();

        foreach ($resourceItems as $resourceItem) {
            $this->incrementResourceItem($resourceItem);
        }

        $this->sortResourceItems();

        return $this;
    }

    /**
     * @return string
     */
    public function getSegregationType(): string
    {
        return $this->segregationType;
    }

    /**
     * @param string $segregationType
     * @return GraphicResource
     */
    public function setSegregationType(string $segregationType): GraphicResource
    {
        $this->segregationType = $segregationType;
        return $this;
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return array_values($this->resourceItems->keys()->all());
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->resourceItems->values()->all();
    }

    /**
     * @param GraphicResourceItem $resourceItem
     */
    protected function incrementResourceItem(GraphicResourceItem $resourceItem)
    {
        $resourceItemKey = $this->getItemLabel($resourceItem);

        $this->resourceItems->put($resourceItemKey, $this->resourceItems->get($resourceItemKey) + $resourceItem->getValue());
    }

    /**
     * @return GraphicResource
     */
    protected function sortResourceItems()
    {
        $resourceItems = $this->resourceItems->all();
        ksort($resourceItems);
        $this->resourceItems = collect($resourceItems);

        return $this;
    }

    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    abstract protected function getItemLabel(GraphicResourceItem $resourceItem);
}
