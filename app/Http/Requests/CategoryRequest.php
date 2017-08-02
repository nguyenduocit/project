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
            'name'      => 'required|min:10|max:255|unique:categorys,name,'.$this->id,
            'type'      => 'required',
            'parent_id' => 'required',

        ];
    }

    public function  messages(){
        return [
            'name.required'      => 'Please enter the category name.',
            'name.min'           => 'The category name can not be too short',
            'name.max'           => 'Your category name must not be longer than 255 characters',
            'name.unique'        =>'The category name can not be identical',
            'type.required'      =>'Please select a category',
            'parent_id.required' =>'Please select a category',
            
        ];
    }
}
