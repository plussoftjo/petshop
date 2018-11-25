<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proudct extends Model
{
	public $with = ['more_images'];
    protected $fillable = [
        'title','image','weight','price','des','catg'
    ];

    public function more_images()
    {
    	return $this->hasMany('App\moreImage');
    }
}
