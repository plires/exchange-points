<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
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
        $rules = [
            'name' => [
                'required',
                'max:255',
                $this->route('category') ? Rule::unique('categories')->ignore($this->route('category')->id) : 'unique:categories'
            ],
            'description' => ['string', 'nullable']
        ];

        return $rules;
    }

    function messages()
    {
        return [
            'name.required'         => 'Ingresá una categoría', 
            'name.string'           => 'la categoría no puede ser un número', 
            'name.max'              => 'El campo categoría no puede exceder los 255 caracteres', 
            'name.unique'           => 'Este nombre de categoría ya esta registrada. Ingresá otra', 
            'description.string'    => 'la descripción no puede ser un número', 
        ];
    }

}
