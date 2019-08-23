<?php

namespace App\Builders\Interfaces;

use App\Components\Condition;
use Illuminate\Database\Query\Builder;

interface ShareProductsQueryBuilderInterface
{
    public function init();

    /**
     * @param $productId
     * @return $this
     */
    public function addProductCondition($productId);

    /**
     * @param Condition $condition
     */
    public function addPropertyCondition(Condition $condition);

    /**
     * @param Condition $condition
     */
    public function addAttributeCondition(Condition $condition);

    /**
     * @return Builder
     */
    public function getQueryBuilder();
}