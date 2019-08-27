<?php

namespace App\Http\Requests\Admin;

class UpdateShareRequest extends ShareRequest
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
            'slug'        => 'required',
            'active_from' => 'date|required',
            'active_to'   => 'date|required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите название акции!',
            'slug.required' => 'Укажите slug!',
            'active_from.required' => 'Укажите начало действия акции!',
            'active_from.date' => 'Укажите правильный формат даты!',
            'active_to.required' => 'Укажите конец дйствия акции!',
            'active_to.date' => 'Укажите правильный формат даты!'
        ];
    }
}
