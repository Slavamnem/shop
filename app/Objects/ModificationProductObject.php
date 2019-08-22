<?php

namespace App\Objects;

use App\Color;
use App\ModelGroup;
use App\Size;
use Illuminate\Support\Collection;

class ModificationProductObject
{
    /**
     * @var Collection
     */
    private $newProducts;
    /**
     * @var ModelGroup
     */
    private $model;
    /**
     * @var Color
     */
    private $color;
    /**
     * @var Size
     */
    private $size;

    /**
     * @param $newProducts
     * @return $this
     */
    public function setNewProducts($newProducts)
    {
        $this->newProducts = $newProducts;
        return $this;
    }

    /**
     * @return Collection
     */
    public function getNewProducts()
    {
        return $this->newProducts;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setModel($value)
    {
        $this->model = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param Color $color
     * @return $this
     */
    public function setColor(Color $color)
    {
        $this->color = $color;
        return $this;
    }

    /**
     * @return Color
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * @param Size $size
     * @return $this
     */
    public function setSize(Size $size)
    {
        $this->size = $size;
        return $this;
    }

    /**
     * @return Size
     */
    public function getSize()
    {
        return $this->size;
    }
}