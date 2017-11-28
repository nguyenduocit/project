<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class CategoryRequest extends Request
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
            'name'      => 'required|max:255|unique:categorys,name,'.$this->id,
            
           

        ];
    }

    public function  messages(){
        return [
            'name.required'      => 'Please enter the category name.',
            'name.max'           => 'Your category name must not be longer than 255 characters',
            'name.unique'        =>'The category name can not be identical',
            
            
            
        ];
    }
}
