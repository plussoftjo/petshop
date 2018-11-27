<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class orderBasket extends Model
{
    protected $fillable = [
        'proudct_id','user_id','order_id','qty'
    ];
}
