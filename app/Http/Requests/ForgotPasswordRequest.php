<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ForgotPasswordRequest extends Request
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
            
            'email'     => 'required|email',
            
        ];


    }

    public function messages()
    {
        return [
        
        'email.required'    => "You need to enter login email",
        'email.email'       => ' Please enter the correct email format.',
        ];
    }
}
