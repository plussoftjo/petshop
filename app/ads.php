<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ads extends Model
{
   public $with = ['User'];
    protected $fillable = [
        'place','type','image','title','des','user_id'
    ];

     public function User() {
    	return $this->belongsTo('App\User');
    }
}
