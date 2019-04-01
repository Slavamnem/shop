<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class CreateCategoryRequest extends FormRequest
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
            'name'     => 'required|string|max:100',
            'slug'     => 'required|string',
            'ordering' => 'int',
        ];
    }

    public function messages()
    {
        return [
            //'required' => 'Поле :attribute обязательно к заполнению',
            'name.required'   => "Укажите имя категории",
            'name.max'        => "Слишком длинное название",
            'slug.required'   => "Укажите slug категории",
            'ordering.int'    => "Поле сортировка должно быть числом",
            //'ordering.required' => "Укажите имя категории",
        ];
    }
}
