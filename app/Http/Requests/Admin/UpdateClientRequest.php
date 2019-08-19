<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateClientRequest extends FormRequest
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
            'name'  => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ];
    }

    public function messages()
    {
        return [
            'name.required'  => 'Поле имя обязательно!',
            'phone.required' => 'Поле телефон обязательно!',
            'email.required' => 'Поле email обязательно!',
            'email.email'    => 'Введите корректный email!',
        ];
    }
}
