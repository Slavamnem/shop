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
use App\Strategies\Graphics\GraphicResource\GraphicResourceTypeStrategy;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class OrderGraphicResource implements GraphicResource
{
    /**
     * @var string
     */
    private $type;
    /**
     * @var Collection
     */
    private $resourceItems;
    /**
     * @var StrategyInterface
     */
    private $graphicResourceTypeStrategy;

    /**
     * OrderGraphicResource constructor.
     */
    public function __construct()
    {
        $this->graphicResourceTypeStrategy = new GraphicResourceTypeStrategy();
    }

    /**
     * @param $value
     * @return $this
     */
    public function setType($value)
    {
        $this->type = $value;
        return $this;
    }

    /**
     * @param Collection $resourceItems
     * @return GraphicResource
     */
    public function setResourceItems(Collection $resourceItems)
    {
        $this->resourceItems = collect();

        foreach ($resourceItems as $resourceItem) {
            $this->incrementItem($resourceItem);
        }

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
    private function incrementItem(GraphicResourceItem $resourceItem)
    {
        $resourceItemKey = $this->graphicResourceTypeStrategy->getStrategy($this->type)->getResourceItemLabel($resourceItem);

        $this->resourceItems->put($resourceItemKey, $this->resourceItems->get($resourceItemKey) + $resourceItem->getValue());
    }
}
