<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class RegisterRequest extends Request
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
            
            'name'      => 'required',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required|min:8',
            'rpassword' => 'required|same:password',
            'phone'     => 'required|numeric',
            'birthday'  => 'required',
            'Image'     => 'required|image|max:2048',
            'address'   => 'required',
        ];


    }
    public function  messages(){
            return [

                'name.required'     => ' Please enter a first and last name.',
                'email.required'    => ' Please enter email.',
                'email.email'       => ' Please enter the correct email format.',
                'email.unique'      => ' The Email was registered .',
                'password.required' => ' Please enter your password.',
                'password.min'      => ' Password long than 8 characters ',
                'rpassword'         => ' Passwords do not match',
                'phone.required'    => ' Please enter a phone number.',
                'phone.numeric'     => ' Phone numbers must be in digital format.',
                'address.required'  => " Please enter a adderss.",
                'birthday.required' => " Please enter a birthday.",
            ];
        }
}