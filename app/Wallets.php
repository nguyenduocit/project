<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallets extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'name', 'color', 'amount', 'created_ad', 'updated_at',
    ];

    public function users(){
    	return $this-> belongsTo('App\User');
    }
}
