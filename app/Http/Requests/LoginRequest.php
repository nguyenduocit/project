<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class LoginRequest extends Request
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
            //
            'email'    =>'required',
            'password' =>'required|min:8'
        ];
    }

    public function messages()
    {
        return [
        'email.required'    => "You need to enter login email",
        'password.required' => "You need to enter a login password",
        'password.min'      => ' Password long than 8 characters ',
        ];
    }
}
