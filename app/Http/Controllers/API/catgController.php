<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\catg;
use App\slider;
use App\proudct;

class catgController extends Controller
{
    public function index($id) 
    {
    	$catg = catg::where('id',$id)->value('title');
    	if($catg == 'قطط') {
    		$type = 'Cats';
    	}
    	if($catg == 'كلاب') {
    		$type = 'Dogs';
    	}

    	$show = catg::where('id',$id)->firstOrFail();
    	$sliders = slider::where('place',$catg)->get();

    	$proudct = proudct::where('catg',$type)->orderBy('id','desc')->get();

    	return response()->json(['sliders' => $sliders,'proudct' => $proudct,'show' => $show]);
    }

    public function hot($id) 
    {
    	$catg = catg::where('id',$id)->value('title');
    	if($catg == 'قطط') {
    		$type = 'Cats';
    	}
    	if($catg == 'كلاب') {
    		$type = 'Dogs';
    	}

    	$show = catg::where('id',$id)->firstOrFail();
    	$sliders = slider::where('place',$catg)->get();

    	$proudct = proudct::where('catg',$type)->orderBy('id','desc')->get();

    	return response()->json(['sliders' => $sliders,'proudct' => $proudct,'show' => $show]);
    }
}
