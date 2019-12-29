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
     * @var Collection
     */
    protected $resourceGrid; //TODO возможно отдельный класс
    /**
     * @var
     */
    protected $itemsLabelDistributorClosure;
    /**
     * @var
     */
    protected $itemsValueQualifierClosure;

    /**
     * @return Collection
     */
    public function getResourceGrid(): Collection
    {
        return $this->resourceGrid;
    }

    /**
     * @return Collection
     */
    public function getResourceItems(): Collection
    {
        return $this->resourceItems;
    }

    /**
     * @param Collection $resourceItems
     * @return GraphicResource
     */
    public function setResourceItems(Collection $resourceItems) : GraphicResource
    {
        $this->resourceItems = $resourceItems;
        return $this;
    }

    /**
     * @param $itemsLabelDistributorClosure
     * @return GraphicResource
     */
    public function setResourceItemsLabelDistributorClosure($itemsLabelDistributorClosure) : GraphicResource
    {
        $this->itemsLabelDistributorClosure = $itemsLabelDistributorClosure;
        return $this;
    }

    /**
     * @param $itemsValueQualifierClosure
     * @return GraphicResource
     */
    public function setResourceItemsValueQualifierClosure($itemsValueQualifierClosure) : GraphicResource
    {
        $this->itemsValueQualifierClosure = $itemsValueQualifierClosure;
        return $this;
    }

    /**
     * @return GraphicResource
     */
    public function buildResourceGrid() : GraphicResource
    {
        $this->resourceGrid = collect();

        foreach ($this->resourceItems as $resourceItem) {
            $resourceItem->setLabel($this->itemsLabelDistributorClosure);
            $resourceItem->setValue($this->itemsValueQualifierClosure);
            $this->addResourceItemToGrid($resourceItem);
        }

        $this->sortResourceGrid();

        return $this;
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return array_values($this->resourceGrid->keys()->all());
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->resourceGrid->values()->all();
    }

    /**
     * @param GraphicResourceItem $resourceItem
     */
    protected function addResourceItemToGrid(GraphicResourceItem $resourceItem)
    {
        $resourceItemKey = $this->getResourceItemLabel($resourceItem);

        $this->resourceGrid->put($resourceItemKey, $this->resourceGrid->get($resourceItemKey) + $resourceItem->getValue());
    }

    /**
     * @return GraphicResource
     */
    protected function sortResourceGrid()
    {
        $resourceGridItems = $this->resourceGrid->all();
        ksort($resourceGridItems);
        $this->resourceGrid = collect($resourceGridItems);

        return $this;
    }

    /**
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    abstract protected function getResourceItemLabel(GraphicResourceItem $resourceItem);
}
