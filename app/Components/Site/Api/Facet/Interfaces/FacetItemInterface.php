<?php

namespace App\Components\Site\Api\Facet\Interfaces;

interface FacetItemInterface
{
    /**
     * @return mixed
     */
    public function getTitle();

    /**
     * @param $value
     * @return $this
     */
    public function setTitle($value);

    /**
    * @param $value
    * @return $this
    */
    public function setAttributeName($value);

    /**
     * @return mixed
     */
    public function getAttributeName();

    public function getIsMarked();

    public function setIsMarked($value);

    public function mark();

    public function unMark();

    public function getMatchProductCount();

    /**
     * @param FacetItemInterface $item
     */
    public function addChildItem(FacetItemInterface $item);
}
