<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 0:57
 */

namespace App\Strategies\Graphics\GraphicResource;


use App\Enums\GraphicSegregationTypesEnum;
use App\Strategies\Graphics\GraphicResource\Strategies\DayGraphicResourceSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\MonthGraphicResourceSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\NullGraphicResourceSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\VariationGraphicResourceSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\YearGraphicResourceSegregationTypeStrategy;
use App\Strategies\Interfaces\GraphicResourceTypeStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class GraphicResourceSegregationTypeStrategy implements StrategyInterface
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
        $this->strategies->put(GraphicSegregationTypesEnum::YEAR()->getValue(), new YearGraphicResourceSegregationTypeStrategy());
        $this->strategies->put(GraphicSegregationTypesEnum::MONTH()->getValue(), new MonthGraphicResourceSegregationTypeStrategy());
        $this->strategies->put(GraphicSegregationTypesEnum::DAY()->getValue(), new DayGraphicResourceSegregationTypeStrategy());
        $this->strategies->put(GraphicSegregationTypesEnum::VARIATION()->getValue(), new VariationGraphicResourceSegregationTypeStrategy());
    }

    /**
     * @param $type
     * @return GraphicResourceTypeStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullGraphicResourceSegregationTypeStrategy();
        }

        return $this->strategies->get($type);
    }
}
