<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UserProfileRequest extends Request
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
            'phone'     => 'required|numeric',
            'birthday'  => 'required',
            'Image'     => 'image|max:2048',
            'address'   => 'required',
        ];


    }
    public function  messages(){
            return [

                'name.required'     => ' Please enter a first and last name.',
                'phone.required'    => ' Please enter a phone number.',
                'phone.numeric'     => ' Phone numbers must be in digital format.',
                'address.required'  => " Please enter a adderss.",
                'birthday.required' => " Please enter a birthday.",
            ];
        }
}
