<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\proudct;
class itemController extends Controller
{
    public function show($id)
    {
    	return response()->json(proudct::where('id',$id)->firstOrFail());
    }

    public function moreItems($catg)
    {
    	return response()->json(proudct::where('catg',$catg)->take(7)->get());
    }
}
