<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ResetPasswordRequest extends Request
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
            
            'password'  =>'required|min:8',
            'rpassword' => 'required|same:password'
        ];
    }


    public function  messages(){
            return [

                'password.required' => ' Please enter your password.',
                'password.min'      => ' Password long than 8 characters ',
                'rpassword'         => ' Passwords do not match',
            ];
        }
}
