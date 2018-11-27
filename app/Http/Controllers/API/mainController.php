<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\slider;
use App\catg;
use App\proudct;
class mainController extends Controller
{
    public function index() 
    {
    	$slider = slider::where('place','main')->get();
    	$catg = catg::get();
    	$proudct = proudct::take(4)->get();
    	$moreProudct = proudct::orderBy('id','desc')->get();
    	return response()->json(['slider' => $slider,'catg' => $catg,'proudct' => $proudct,'moreProudct' => $moreProudct]);
    }
}
