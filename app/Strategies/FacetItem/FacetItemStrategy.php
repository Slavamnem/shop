<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 12.09.2019
 * Time: 0:43
 */

namespace App\Strategies\FacetItem;


use App\Strategies\FacetItem\Strategies\AttributeFacetItemStrategy;
use App\Strategies\FacetItem\Strategies\CategoryFacetItemStrategy;
use App\Strategies\FacetItem\Strategies\NullFacetItemStrategy;
use App\Strategies\FacetItem\Strategies\PropertyFacetItemStrategy;
use App\Strategies\Interfaces\FacetItemStrategyInterface;
use App\Strategies\Interfaces\StrategyInterface;
use Illuminate\Support\Collection;

class FacetItemStrategy implements StrategyInterface
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
        $this->strategies->put('category', new CategoryFacetItemStrategy());
        $this->strategies->put('attribute', new AttributeFacetItemStrategy());
        $this->strategies->put('property', new PropertyFacetItemStrategy());
    }

    /**
     * @param $type
     * @return FacetItemStrategyInterface
     */
    public function getStrategy($type){
        if (!$this->strategies->has($type)) {
            return new NullFacetItemStrategy();
        }

        return $this->strategies->get($type);
    }
}