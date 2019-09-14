<?php

namespace App\Strategies\Delivery;

use App\Components\Interfaces\DeliveryTypeInterface;
use App\Enums\DeliveryTypesEnum;
use App\Strategies\Delivery\Strategies\JustinDelivery;
use App\Strategies\Delivery\Strategies\NovaPoshtaDelivery;
use App\Strategies\Delivery\Strategies\NullDelivery;
use App\Strategies\Delivery\Strategies\PickUpDelivery;
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
        $this->strategies->put(DeliveryTypesEnum::NOVA_POSHTA, new NovaPoshtaDelivery());
        $this->strategies->put(DeliveryTypesEnum::JUSTIN, new JustinDelivery());
        $this->strategies->put(DeliveryTypesEnum::SELF, new PickUpDelivery());
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
