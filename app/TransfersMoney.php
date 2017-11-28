<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TransfersMoney extends Model
{
    //
     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'transfer_wallet','receive_wallet','amount','user_id','	created_at','updated_at',
    ];

    
}
