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
use App\Strategies\Graphics\GraphicResource\GraphicResourceSegregationTypeStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

abstract class AbstractGraphicResource implements GraphicResource
{
    /**
     * @var Collection
     */
    protected $resourceItems;

    /**
     * AbstractGraphicResource constructor.
     */
    public function __construct(){}

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

        return $this;
    }

    /**
     * @return array
     */
    public function getLabels()
    {
        return array_values($this->resourceItems->keys()->all()); //TODO sorting
    }

    /**
     * @return array
     */
    public function getValues()
    {
        return $this->resourceItems->values()->all(); //TODO sorting
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
     * @param GraphicResourceItem $resourceItem
     * @return mixed
     */
    abstract protected function getItemLabel(GraphicResourceItem $resourceItem);
}
