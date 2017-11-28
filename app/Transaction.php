<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    //
     protected $fillable = [
        'category_id','user_id','wallets_id','amount','describe', 'created_at', 'updated_at',
    ];


}
