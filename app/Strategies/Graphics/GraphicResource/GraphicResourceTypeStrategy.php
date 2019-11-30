<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 0:57
 */

namespace App\Strategies\Graphics\GraphicResource;


use App\Strategies\Graphics\GraphicResource\Strategies\MonthGraphicResourceTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\NullGraphicResourceTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\VariationGraphicResourceTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\YearGraphicResourceTypeStrategy;
use App\Strategies\Interfaces\GraphicResourceTypeStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class GraphicResourceTypeStrategy implements StrategyInterface
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
        $this->strategies->put('year', new YearGraphicResourceTypeStrategy());
        $this->strategies->put('month', new MonthGraphicResourceTypeStrategy());
        $this->strategies->put('variation', new VariationGraphicResourceTypeStrategy());
    }

    /**
     * @param $type
     * @return GraphicResourceTypeStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullGraphicResourceTypeStrategy();
        }

        return $this->strategies->get($type);
    }
}
