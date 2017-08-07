<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;


class TransactionRequest extends Request
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
        
            'amount' => 'required|numeric',
        ];
    }

    public function  messages(){
        return [

            'amount.required' => 'Enter the amount in the transaction',
            'amount.numeric'  => 'Amount must be numeric',
            

        ];
    }
}
