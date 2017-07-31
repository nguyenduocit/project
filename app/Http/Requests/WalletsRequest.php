<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class WalletsRequest extends Request
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
            'name'   => 'required|min:4|max:255|unique:wallets,name,'.$this->id,
            'amount' => 'required|numeric|max:18',
        ];
    }

    public function  messages(){
        return [

            
            'name.required'   => 'Please enter the wallet name.',
            'name.min'        => 'The wallet name can not be too short',
            'name.max'        => 'Your wallet name must not be longer than 255 characters',
            'name.unique'     =>'The wallet name can not be identical',
            'amount.required' => 'Enter the amount in the wallet',
            'amount.numeric'  => 'Amount must be numeric',
            'amount.max'      => 'Your amount must not exceed 18 digits',

        ];
    }
}
