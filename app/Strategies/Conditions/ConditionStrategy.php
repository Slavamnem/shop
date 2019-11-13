<?php

namespace App\Strategies\Conditions;

use App\Components\Order\Delivery\JustinDelivery;
use App\Components\Order\Delivery\NovaPoshtaDelivery;
use App\Components\Order\Delivery\NullDelivery;
use App\Components\Order\Delivery\PickUpDelivery;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class ConditionStrategy implements StrategyInterface
{
    /**
     * @var Collection
     */
    private $strategies;

    public function __construct()
    {
        $this->loadStrategies();
    }

    public function loadStrategies() //TODO singletons, memory saving
    {
        $this->strategies = collect();
        $this->strategies->put('id', IdCondition::Instance());
        $this->strategies->put('category_id', new CategoryCondition());
        $this->strategies->put('group_id', new ModelCondition());
        $this->strategies->put('status_id', new StatusCondition());
        $this->strategies->put('color_id', new ColorCondition());
        $this->strategies->put('size_id', new SizeCondition());
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new PropertyCondition($type);
        }

        return $this->strategies->get($type);
    }
}
