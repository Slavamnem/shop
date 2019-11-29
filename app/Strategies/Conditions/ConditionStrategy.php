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
        $this->strategies->put('id', IdCondition::getInstance());
        $this->strategies->put('category_id', CategoryCondition::getInstance());
        $this->strategies->put('group_id', ModelCondition::getInstance());
        $this->strategies->put('status_id', StatusCondition::getInstance());
        $this->strategies->put('color_id', ColorCondition::getInstance());
        $this->strategies->put('size_id', SizeCondition::getInstance());
    }

    /**
     * @param $type
     * @return mixed
     */
    public function getStrategy($type){
        dump(2);
        if (!$this->strategies->has($type)) {
            return PropertyCondition::getInstance();
        }
        dump(3);

        dump($type);
        return $this->strategies->get($type);
    }
}
