<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class EditOrderRequest extends FormRequest
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
            'sum'   => 'required|numeric',
            'phone' => 'required',
            'email' => 'email',
            'city'  => 'required'
        ];
    }

    public function messages()
    {
        return [
            'phone.required' => 'Поле телефон обязательно!',
            'sum.required'   => 'Поле сумма обязательно!',
            'city.required'  => 'Поле город обязательно!',
            'email.email'    => 'Введите валидный email!',
        ];
    }
}
