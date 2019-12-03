<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 01.12.2019
 * Time: 0:57
 */

namespace App\Strategies\Graphics\GraphicResource;


use App\Enums\GraphicSegregationTypesEnum;
use App\Strategies\Graphics\GraphicResource\Strategies\DayGraphicResourceSegregationSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\HourGraphicResourceSegregationSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\MonthGraphicResourceSegregationSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\NullGraphicResourceSegregationSegregationTypeStrategy;
use App\Strategies\Graphics\GraphicResource\Strategies\YearGraphicResourceSegregationSegregationTypeStrategy;
use App\Strategies\Interfaces\GraphicResourceSegregationTypeStrategyInterface;
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
        $this->strategies->put(GraphicSegregationTypesEnum::YEAR()->getValue(), new YearGraphicResourceSegregationSegregationTypeStrategy());
        $this->strategies->put(GraphicSegregationTypesEnum::MONTH()->getValue(), new MonthGraphicResourceSegregationSegregationTypeStrategy());
        $this->strategies->put(GraphicSegregationTypesEnum::DAY()->getValue(), new DayGraphicResourceSegregationSegregationTypeStrategy());
        $this->strategies->put(GraphicSegregationTypesEnum::HOUR()->getValue(), new HourGraphicResourceSegregationSegregationTypeStrategy());
    }

    /**
     * @param $type
     * @return GraphicResourceSegregationTypeStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullGraphicResourceSegregationSegregationTypeStrategy();
        }

        return $this->strategies->get($type);
    }
}
