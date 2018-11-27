<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\basket;
use Auth;
class basketController extends Controller
{
    public function store(Request $request)
    {
    	$user_id = Auth::id();

    	$create = basket::create([
    		'user_id' => $user_id,
    		'proudct_id' => $request->proudct_id,
    		'qty' => $request->qty
    	]);
    }

    public function index()
    {
    	$user_id = Auth::id();

    	return response()->json(basket::where('user_id',$user_id)->get());
    }

    public function updateQty(Request $request,$id)
    {
    	basket::where('id',$id)->update(['qty' => $request->qty]);
    }

    public function destroy($id)
    {
        return basket::where('id',$id)->delete();
    }
}
