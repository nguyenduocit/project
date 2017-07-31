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
            'email'     => 'required|email|unique:users,email,'. $this->id,
            'password'  => 'required|min:6',
            'rpassword' => 'required|same:password',
            'phone'     => 'numeric',
            'Image'     => 'image|max:2048',
            
        ];


    }
    public function  messages(){
            return [

                'name.required'     => ' Please enter a first and last name.',
                'email.required'    => ' Please enter email.',
                'email.email'       => ' Please enter the correct email format.',
                'email.unique'      => ' The Email was registered .',
                'password.required' => ' Please enter your password.',
                'password.min'      => ' Password long than 6 characters ',
                'rpassword'         => ' Passwords do not match',
                'phone.numeric'     => ' Phone numbers must be in digital format.',
                
                
            ];
        }
}