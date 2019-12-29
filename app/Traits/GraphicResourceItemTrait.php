<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.12.2019
 * Time: 0:10
 */

namespace App\Traits;

use Carbon\Carbon;

trait GraphicResourceItemTrait
{
    /**
     * @var string
     */
    protected $label;
    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getLabel() : string
    {
        return $this->label;
    }

    /**
     * @param null $itemsLabelDistributorClosure
     * @return $this
     */
    public function setLabel($itemsLabelDistributorClosure = null)
    {
        $this->label = is_callable($itemsLabelDistributorClosure) ? $itemsLabelDistributorClosure($this) : '?';
        return $this;
    }

    /**
     * @return string
     */
    public function getValue() : string
    {
        return $this->value;
    }

    /**
     * @param null $itemsValueQualifierClosure
     * @return $this
     */
    public function setValue($itemsValueQualifierClosure = null)
    {
        $this->value = is_callable($itemsValueQualifierClosure) ? $itemsValueQualifierClosure($this) : 1;
        return $this;
    }

    /**
     * @return Carbon
     */
    public function getCreationDate() : Carbon
    {
        return $this->created_at;
    }
}