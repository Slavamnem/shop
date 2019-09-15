<?php

namespace App\Http\Requests\Site\Api;

use Illuminate\Foundation\Http\FormRequest;

class CatalogProductsFilterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
//            'request' => 'required',
        ];
    }

    /**
     * @return mixed
     */
    public function getRequestData()
    {
        parse_str($this->input('request'), $requestData);

        return $requestData;
    }

    /**
     * @return array
     */
    public function getFilteredCategories()
    {
        return array_keys((array)@array_get($this->getRequestData(), 'category'));
    }

    /**
     * @param $catId
     * @return bool
     */
    public function isFilteredCategory($catId)
    {
        return in_array($catId, $this->getFilteredCategories());
    }

    /**
     * @param $attribute
     * @return array
     */
    public function getFilteredAttributeValues($attribute)
    {
        return array_keys((array)@array_get($this->getRequestData(), $attribute));
    }

    /**
     * @param $attribute
     * @param $valueId
     * @return bool
     */
    public function isFilteredAttributeValue($attribute, $valueId)
    {
        return in_array($valueId, $this->getFilteredAttributeValues($attribute));
    }

    /**
     * @param $property
     * @return array
     */
    public function getFilteredPropertyValues($property)
    {
        return array_keys((array)@array_get($this->getRequestData(), $property));
    }

    /**
     * @param $property
     * @param $propertyValueId
     * @return bool
     */
    public function isFilteredPropertyValue($property, $propertyValueId)
    {
        return in_array($propertyValueId, $this->getFilteredPropertyValues($property));
    }

    /**
     * @return mixed
     */
    public function getMinPrice()
    {
        return @array_get($this->getRequestData(), 'minPrice',0);
    }

    /**
     * @return mixed
     */
    public function getMaxPrice()
    {
        if ($maxPrice = (int)@array_get($this->getRequestData(), 'maxPrice')) {
            return $maxPrice;
        }

        return 100000;
    }

    /**
     * @return mixed
     */
    public function getPage()
    {
        return @array_get($this->getRequestData(), 'page', 1);
    }
}
