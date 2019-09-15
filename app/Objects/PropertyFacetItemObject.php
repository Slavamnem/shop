<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.09.2019
 * Time: 1:01
 */

namespace App\Objects;

class PropertyFacetItemObject
{
    /**
     * @var
     */
    private $request;
    /**
     * @var
     */
    private $propertyTitle;
    /**
     * @var
     */
    private $propertyName;
    /**
     * @var
     */
    private $propertyValue;

    /**
     * @param $request
     * @return $this
     */
    public function setRequest($request)
    {
        $this->request = $request;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPropertyTitle($value)
    {
        $this->propertyTitle = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPropertyTitle()
    {
        return $this->propertyTitle;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPropertyName($value)
    {
        $this->propertyName = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPropertyName()
    {
        return $this->propertyName;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setPropertyValue($value)
    {
        $this->propertyValue = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPropertyValue()
    {
        return $this->propertyValue;
    }

    /**
     * @return string
     */
    public function getItemKey()
    {
        return "{$this->getPropertyName()}:{$this->getPropertyValue()}";
    }

    /**
     * @return string
     */
    public function getHtmlName()
    {
        return "{$this->getPropertyName()}[{$this->getPropertyValue()}]";
    }
}
