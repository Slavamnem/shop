<?php

namespace App\Http\Requests\Admin\Stock;

use Illuminate\Foundation\Http\FormRequest;

class ChangeProductQuantityRequest extends FormRequest
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
            'productId' => 'required|exists:products,id',
            'quantity'  => 'int',
        ];
    }

    /**
     * @return array
     */
    public function messages()
    {
        return [
            'productId.required' => "Товар не выбран!",
            'productId.exists'   => "Товар не найден!",
            'quantity.int'       => "Выбрано не числовое значение!",
        ];
    }

    /**
     * @return int
     */
    public function getProductId() : int
    {
        return $this->input('productId');
    }

    /**
     * @return int
     */
    public function getProductQuantity() : int
    {
        return $this->input('quantity');
    }
}
