<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'name'      => 'required',
            'last_name' => 'required',
            'email'     => 'required|email',
            'login'     => 'required',
            'password'  => 'required|min:4',
        ];
    }

    public function messages()
    {
        return [
            'name.required'      => 'Поле имя обязательно!',
            'last_name.required' => 'Поле фамилия обязательно!',
            'email.email'        => 'Введите корректный email!',
            'email.required'     => 'Поле email обязательно!',
            'login.required'     => 'Поле логин обязательно!',
            'password.required'  => 'Поле пароль обязательно!',
        ];
    }
}
