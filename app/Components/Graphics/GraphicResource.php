<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 30.11.2019
 * Time: 18:00
 */

namespace App\Components\Graphics;

use Illuminate\Support\Collection;

interface GraphicResource
{
    /**
     * @return Collection
     */
    public function getResourceGrid(): Collection;

    /**
     * @return Collection
     */
    public function getResourceItems(): Collection;

    /**
     * @param Collection $resourceItems
     * @return GraphicResource
     */
    public function setResourceItems(Collection $resourceItems) : GraphicResource;

    /**
     * @param $itemsLabelDistributorClosure
     * @return GraphicResource
     */
    public function setResourceItemsLabelDistributorClosure($itemsLabelDistributorClosure) : GraphicResource;

    /**
     * @param $itemsValueQualifierClosure
     * @return GraphicResource
     */
    public function setResourceItemsValueQualifierClosure($itemsValueQualifierClosure) : GraphicResource;

    /**
     * @return GraphicResource
     */
    public function buildResourceGrid() : GraphicResource;

    /**
     * @return array
     */
    public function getLabels();

    /**
     * @return array
     */
    public function getValues();
}
