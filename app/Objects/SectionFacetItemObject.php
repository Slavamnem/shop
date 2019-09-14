<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.09.2019
 * Time: 1:01
 */

namespace App\Objects;

use App\Components\Site\Api\Facet\Interfaces\FacetObjectInterface;

class SectionFacetItemObject
{
    /**
     * @var
     */
    private $key;
    /**
     * @var
     */
    private $title;
    /**
     * @var FacetObjectInterface
     */
    private $facetObject;

    /**
     * @param $value
     * @return $this
     */
    public function setKey($value)
    {
        $this->key = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * @param FacetObjectInterface $facetObject
     * @return $this
     */
    public function setFacetObject(FacetObjectInterface $facetObject)
    {
        $this->facetObject = $facetObject;
        return $this;
    }

    /**
     * @return FacetObjectInterface
     */
    public function getFacetObject()
    {
        return $this->facetObject;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setTitle($value)
    {
        $this->title = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }
}
