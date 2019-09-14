<?php

namespace App\Components\Site\Api\Facet\Interfaces;

interface FacetItemInterface
{
    /**
     * @return mixed
     */
    public function getKey();

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

    /**
     * @param $value
     * @return $this
     */
    public function setIsMarked($value);

    /**
     * @return $this
     */
    public function mark();

    /**
     * @return $this
     */
    public function unMark();

    /**
     * @return bool
     */
    public function isSection();

    /**
     * @param FacetObjectInterface $facetObject
     * @return $this
     */
    public function setFacetObject(FacetObjectInterface $facetObject);

    /**
     * @return FacetObjectInterface
     */
    public function getFacetObject();

    public function getMatchProductCount();

    /**
     * @param FacetItemInterface $item
     */
    public function addChildItem(FacetItemInterface $item);
}
