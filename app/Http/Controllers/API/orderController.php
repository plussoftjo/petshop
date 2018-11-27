<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\order;
use Auth;
use Validator;
use App\basket;
use App\orderBasket;
class orderController extends Controller
{
    public function store(Request $req)
    {
    	$validator = Validator::make($req->all(), [ 
            'name' => 'required', 
            'phone' => 'required', 
            'city' => 'required', 
            'address' => 'required', 
        ]);

        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
   		 }


   		 $order = order::create([
   		 	'name' => $req->name,
   		 	'phone' => $req->phone,
   		 	'city' => $req->city,
   		 	'address' => $req->address,
   		 	'user_id' => Auth::id(),
        'done' => 0
   		 ]);

   		 $basket = basket::where('user_id',Auth::id())->get();

   		 foreach ($basket as $b) {
   		 	orderBasket::create([
   		 		'order_id' => $order->id,
   		 		'user_id' => Auth::id(),
   		 		'proudct_id' => $b->proudct_id,
   		 		'qty' => $b->qty
   		 	]);
   		 }

   		 basket::where('user_id',Auth::id())->delete();

    }	

    public function index() {
      return response()->json(order::where('user_id',Auth::id())->orderBy('id','desc')->get());
    }
}
