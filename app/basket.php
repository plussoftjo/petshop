<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class basket extends Model
{

	public $with = ['proudct'];
    protected $fillable = [
        'proudct_id','user_id','qty'
    ];

    public function proudct() {
    	return $this->belongsTo('App\proudct');
    }
}
