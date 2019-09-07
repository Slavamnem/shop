<?php

namespace App\Components\Site\Api\Facet;

use App\Components\Site\Api\Facet\Interfaces\FacetItemInterface;
use Illuminate\Support\Collection;

class FacetItem implements FacetItemInterface
{
    /**
     * @var
     */
    private $title;
    /**
     * @var
     */
    private $attributeName;
    /**
     * @var bool
     */
    private $isMarked;
    /**
     * @var Collection
     */
    private $childrenItems;

    public function __construct()
    {
        $this->childrenItems = collect();
    }

    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
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
     * @param $value
     * @return $this
     */
    public function setAttributeName($value)
    {
        $this->attributeName = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributeName()
    {
        return $this->attributeName;
    }

    public function getIsMarked()
    {
        return $this->isMarked;
    }

    public function setIsMarked($value)
    {
        $this->isMarked = $value;
        return $this;
    }

    public function mark()
    {
        $this->isMarked = true;
    }

    public function unMark()
    {
        $this->isMarked = false;
    }

    public function getMatchProductCount()
    {
        return 7; //TODO
    }

    /**
     * @param FacetItemInterface $item
     */
    public function addChildItem(FacetItemInterface $item)
    {
        $this->childrenItems->push($item);
    }

    /**
     * @return Collection
     */
    public function getChildren()
    {
        return $this->childrenItems;
    }
}
