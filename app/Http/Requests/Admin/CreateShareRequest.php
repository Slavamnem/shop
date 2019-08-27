<?php

namespace App\Http\Requests\Admin;

class CreateShareRequest extends ShareRequest
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
            'active_from' => 'required',
            'active_to'   => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Укажите название акции!',
            'slug.required' => 'Укажите slug!',
            'active_from.required' => 'Укажите начало действия акции!',
            'active_to.required' => 'Укажите конец дйствия акции!'
        ];
    }
}
