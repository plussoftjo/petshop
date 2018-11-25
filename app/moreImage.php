<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class moreImage extends Model
{
    protected $fillable = [
        'proudct_id','image'
    ];

    public function proudct() {
    	return $this->belongsTo('App\proudct');
    }

    
}
