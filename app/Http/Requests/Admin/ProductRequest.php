<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * @return array
     */
    public function getProperties()
    {
        return (array)$this->input('properties');
    }

    /**
     * @param $number
     * @return mixed
     */
    public function getPropertyValue($number)
    {
        return array_get($this->input('properties_values'), $number);
    }

    /**
     * @param $number
     * @return mixed
     */
    public function getPropertyOrdering($number)
    {
        return array_get($this->input('properties_ordering'), $number);
    }

    /**
     * @return array
     */
    public function getOldImages()
    {
        return (array)@$this->oldImages;
    }

    /**
     * @return array
     */
    public function getNewImages()
    {
        return (array)@$this->newImages;
    }

    /**
     * @param $imgId
     * @return mixed
     */
    public function getNewImageIsMain($imgId)
    {
        return @array_get($this->newImagesMain, $imgId) ?? 0;
    }

    /**
     * @param $imgId
     * @return mixed
     */
    public function getNewImageIsPreview($imgId)
    {
        return @array_get($this->newImagesPreview, $imgId) ?? 0;
    }

    /**
     * @param $imgId
     * @return mixed
     */
    public function getNewImageOrdering($imgId)
    {
        return @array_get($this->newImagesOrdering, $imgId) ?? 100;
    }

    /**
     * @param $imgId
     * @return mixed
     */
    public function getOldImageIsMain($imgId)
    {
        return @array_get($this->oldImagesMain, $imgId) ?? 0;
    }

    /**
     * @param $imgId
     * @return mixed
     */
    public function getOldImageIsPreview($imgId)
    {
        return @array_get($this->oldImagesPreview, $imgId) ?? 0;
    }

    /**
     * @param $imgId
     * @return mixed
     */
    public function getOldImageOrdering($imgId)
    {
        return @array_get($this->oldImagesOrdering, $imgId) ?? 100;
    }
}
