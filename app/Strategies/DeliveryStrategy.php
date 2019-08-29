<?php

namespace App\Strategies;

use App\Components\Interfaces\DeliveryTypeInterface;
use App\Components\Order\Delivery\JustinDelivery;
use App\Components\Order\Delivery\NovaPoshtaDelivery;
use App\Components\Order\Delivery\NullDelivery;
use App\Components\Order\Delivery\PickUpDelivery;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class DeliveryStrategy implements StrategyInterface
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
        $this->strategies->put(1, new NovaPoshtaDelivery());
        $this->strategies->put(2, new JustinDelivery());
        $this->strategies->put(3, new PickUpDelivery());
    }

    /**
     * @param $type
     * @return DeliveryTypeInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullDelivery();
        }

        return $this->strategies->get($type);
    }
}
