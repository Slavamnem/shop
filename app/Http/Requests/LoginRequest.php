<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Cache;

class LoginRequest extends FormRequest
{
    const MAX_LOGIN_FAILS = 3;
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (Cache::get("login-fails") > self::MAX_LOGIN_FAILS) {
            Cache::put("login-block", true, 0.1);
            Cache::put("login-fails", 0);
            abort(403);
        }
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
            'login'     => 'required|string',
            'password'  => 'required|string',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'Поле :attribute обязательно к заполнению',
        ];
    }
}
