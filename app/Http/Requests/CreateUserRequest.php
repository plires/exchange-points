<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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

        if ( $this->request->has('points_old') ) {

            return [
                'id'              => ['required', 'numeric'],
                'points_old'      => ['required', 'numeric'],
                'points'          => ['required', 'numeric'],
            ];

        } else {

            return [
                'name'              => ['required', 'string', 'max:255'],
                'lastname'          => ['required', 'string', 'max:255'],
                'document'          => ['required', 'string', 'max:20'],
                'role_id'           => ['required', 'numeric'],
                'email'             => [
                    'required',
                    'string',
                    'email',
                    'max:255',
                    $this->route('user') ? Rule::unique('users')->ignore($this->route('user')->id) : 'unique:users'
                ],
                'birthday'          => ['date', 'nullable'],
                'phone'             => ['string', 'nullable', 'max:255'],
                'street'            => ['string', 'nullable', 'max:255'],
                'street_number'     => ['string', 'nullable', 'max:255'],
                'city'              => ['string', 'nullable', 'max:255'],
                'province'          => ['string', 'nullable', 'max:255'],
                'country'           => ['string', 'nullable', 'max:255'],
                'postal_code'       => ['string', 'nullable', 'max:255'],
                'password'          => [
                    'min:4',
                    'max:8',
                    'confirmed',
                    $this->route('user') ? 'nullable' : ''
                ]
            ];

        }

    }

    function messages()
    {
        return [
            'name.required'         => 'Ingres?? un nombre', 
            'name.max'              => 'El campo nombre no puede tener mas de 255 caracteres',
            'lastname.required'     => 'Ingres?? un apellido', 
            'lastname.max'          => 'El campo apellido no puede tener mas de 255 caracteres',
            'document.required'     => 'Ingres?? un documento de identidad', 
            'document.max'          => 'El campo documento de identidad no puede tener mas de 20 caracteres', 
            'role_id.required'      => 'Ingres?? un rol de usuario', 
            'role_id.numeric'       => 'Ingres?? un rol de usuario v??lido',
            'email.required'        => 'Ingres?? un email', 
            'email.email'           => 'Ingres?? un email v??lido', 
            'email.max'             => 'El campo email no puede tener mas de 255 caracteres', 
            'birthday.date'         => 'El campo fecha de nacimiento debe tener un formato "AAAA-MM-DD" ', 
            'password.min'          => 'La contrase??a no puede tener menos de 4 caracteres', 
            'password.max'          => 'La contrase??a no puede tener mas de 8 caracteres', 
            'password.confirmed'    => 'Las contrase??as no coinciden', 
            'phone.max'             => 'El tel??fono no puede tener mas de 255 caracteres', 
            'street.max'            => 'La calle no puede tener mas de 255 caracteres', 
            'street_number.max'     => 'El numero de calle no puede tener mas de 255 caracteres', 
            'city.max'              => 'La ciudad no puede tener mas de 255 caracteres', 
            'province.max'          => 'La provincia no puede tener mas de 255 caracteres', 
            'country.max'           => 'El pa??s no puede tener mas de 255 caracteres', 
            'postal_code.max'       => 'El c??digo postal no puede tener mas de 255 caracteres', 
            'points_old.required'   => 'Hubo un error, intente nuevamente', 
            'points_old.numeric'    => 'Hubo un error, intente nuevamente', 
            'points.required'       => 'Ingres?? un numero de puntos', 
            'points.numeric'        => 'Ingres?? un numero de puntos entero (negativo para restar, positivo para sumar)', 
        ];
    }


}
