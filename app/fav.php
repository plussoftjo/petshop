<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class fav extends Model
{
    public $with = ['proudct'];
    protected $fillable = [
        'proudct_id','user_id'
    ];

     public function proudct() {
    	return $this->belongsTo('App\proudct');
    }
}
