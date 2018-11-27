<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\fav;
use Auth;

class favController extends Controller
{
    public function store($id)
    {
    	return fav::create([
    		'user_id' => Auth::id(),
    		'proudct_id' => $id
    	]);
    }

    public function index()
    {
    	return response()->json(fav::where('user_id',Auth::id())->get());
    }

    public function destroy($id)
    {
    	return fav::where('id',$id)->delete();
    }
}
