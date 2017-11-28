<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorys extends Model
{
    
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','type','parent_id','user_id','created_at','updated_at',
    ];

}
