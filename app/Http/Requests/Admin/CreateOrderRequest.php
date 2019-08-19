<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
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
            'phone'         => 'required|min:10|max:12',
            'city'          => 'required|exists:cities,ref',
            'delivery_type' => 'required|exists:delivery_types,id',
            'payment_type'  => 'required|exists:payment_types,id',
        ];
    }

    public function messages()
    {
        return [
            'phone.required'         => 'Поле телефон обязательно!',
            'phone.min'              => 'Введите корректный номер!',
            'phone.max'              => 'Введите корректный номер!',
            'city.required'          => 'Обязательно выберите город!',
            'city.exists'            => 'Выбранный город не найден!',
            'delivery_type.required' => 'Обязательно тип доставки!',
            'delivery_type.exists'   => 'Выбранный тип доставки не существует!',
            'payment_type.required'  => 'Обязательно тип оплаты!',
            'payment_type.exists'    => 'Выбранный тип оплаты не существует!',
        ];
    }
}
