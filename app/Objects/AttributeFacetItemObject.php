<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 14.09.2019
 * Time: 1:01
 */

namespace App\Objects;

class AttributeFacetItemObject
{
    /**
     * @var
     */
    private $request;
    /**
     * @var
     */
    private $attributeTitle;
    /**
     * @var
     */
    private $attributeName;
    /**
     * @var
     */
    private $attributeValue;

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
    public function setAttributeTitle($value)
    {
        $this->attributeTitle = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributeTitle()
    {
        return $this->attributeTitle;
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

    /**
     * @param $value
     * @return $this
     */
    public function setAttributeValue($value)
    {
        $this->attributeValue = $value;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getAttributeValue()
    {
        return $this->attributeValue;
    }

    /**
     * @return string
     */
    public function getItemKey()
    {
        return "{$this->getAttributeName()}-{$this->getAttributeValue()}";
    }

    /**
     * @return string
     */
    public function getHtmlName()
    {
        return "{$this->getAttributeName()}[{$this->getAttributeValue()}]";
    }
}
