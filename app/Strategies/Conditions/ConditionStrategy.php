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

    public function loadStrategies()
    {
        $this->strategies = collect();
        $this->strategies->put('id', IdCondition::Instance());
        $this->strategies->put('category_id', CategoryCondition::Instance());
        $this->strategies->put('group_id', ModelCondition::Instance());
        $this->strategies->put('status_id', StatusCondition::Instance());
        $this->strategies->put('color_id', ColorCondition::Instance());
        $this->strategies->put('size_id', SizeCondition::Instance());
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
