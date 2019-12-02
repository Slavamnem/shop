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
     * @var string
     */
    protected $segregationType;
    /**
     * @var Collection
     */
    protected $resourceItems;
    /**
     * @var StrategyInterface
     */
    protected $segregationTypeStrategy;

    /**
     * OrderGraphicResource constructor.
     */
    public function __construct()
    {
        $this->segregationTypeStrategy = new GraphicResourceSegregationTypeStrategy();
    }

    /**
     * @return string
     */
    public function getSegregationType(): string
    {
        return $this->segregationType;
    }

    /**
     * @param $value
     * @return GraphicResource
     */
    public function setSegregationType($value)
    {
        dd($value);
        $this->segregationType = $value;
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
    protected function incrementItem(GraphicResourceItem $resourceItem)
    {
        dump($this->getSegregationType());
        $resourceItemKey = $this->segregationTypeStrategy->getStrategy($this->segregationType)->getResourceItemLabel($resourceItem);

        $this->resourceItems->put($resourceItemKey, $this->resourceItems->get($resourceItemKey) + $resourceItem->getValue());
    }
}
