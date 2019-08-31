<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateSiteElementRequest extends FormRequest
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
            'key'   => 'required|max:100',
            'type'  => 'required|in:text,image',
            'value' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'key.required' => 'Укажите ключ элемента!',
            'value.required' => 'Укажите значение элемента!',
            'type.required' => 'Укажите тип элемента!',
        ];
    }
}
