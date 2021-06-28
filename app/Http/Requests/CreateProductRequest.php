<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {   
        // Aca se puede validar si el usuario que esta usando el form esta habilitado o no
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
            'sku'               => [
                'required',
                'string',
                'max:255',
                $this->route('product') ? Rule::unique('products')->ignore($this->route('product')->id) : 'unique:products'
            ],
            'image'             => ['max:2000', 'image'],
            'name'              => ['required', 'string', 'max:255'],
            'price'             => ['required', 'numeric', 'min:0'],
            'description'       => ['string', 'nullable'],
            'availability'      => ['required', 'numeric'],
            'category_id'       => ['required', 'numeric', 'min:0', 'not_in:0'],
            'is_active'         => ['required', 'bool'],
            'featured'          => ['required', 'bool'],
        ];

        return $rules;
    }

    function messages()
    {
        return [
            'sku.required'          => 'Ingresá un SKU', 
            'sku.max'               => 'El campo SKU no puede tener mas de 255 caracteres', 
            'sku.unique'            => 'Este SKU ya se encuentra en uso.', 
            'name.required'         => 'Ingresá un nombre para el producto', 
            'name.max'              => 'El campo nombre no puede tener mas de 255 caracteres', 
            'price.required'        => 'Ingresá un precio', 
            'price.numeric'         => 'El valor del precio debe ser un entero',
            'price.min'             => 'El valor del precio no puede ser menor o igual a 0',
            'availability.required' => 'Ingresá el stock', 
            'availability.numeric'  => 'El valor del stock debe ser un entero', 
            'category_id.required'  => 'Seleccioná una categoría', 
            'category_id.numeric'   => 'La categoría seleccionada no es válida', 
            'category_id.min'       => 'La categoría seleccionada no es válida', 
            'category_id.not_in'    => 'La categoría seleccionada no es válida', 
            'image.image'           => 'Subí una imágen válida', 
            'image.max'             => 'La imágen no puede superar los 2MB'
        ];
    }


}
