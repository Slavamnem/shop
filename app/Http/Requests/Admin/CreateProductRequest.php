<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
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
            'name'        => 'required',
            'slug'        => 'required|string|unique:products,slug',
            'base_price'  => 'required|numeric|between:0,1000000',
            'quantity'    => 'required|integer|between:0,1000000',
            'category_id' => 'required|exists:categories,id',
            'group_id'    => 'required|exists:model_groups,id',
            'color_id'    => 'required|exists:colors,id',
            'size_id'     => 'required|exists:sizes,id',
        ]; //TODO ordering
    }
}
