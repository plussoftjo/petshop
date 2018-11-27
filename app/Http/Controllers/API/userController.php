<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use App\User;
use Validator;
class userController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'phone' => 'required|unique:users', 
            'password' => 'required', 
            'has' => 'required', 
        ]);

    if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
    }

    $user = User::create([
        'name' => $request->name,
        'phone' => $request->phone,
        'has' => $request->has,
        'password' => bcrypt($request->password),
    ]);

   $success['token'] =  $user->createToken('petshop')-> accessToken;

    return response()->json(['success' => $success,], 200); 

    }

    public function login(Request $request)
    {
         if(Auth::attempt(['phone' => request('phone'), 'password' => request('password')])){ 
                $user = Auth::User(); 
                $success['token'] =  $user->createToken('petshop')-> accessToken; 
                $userApp = new User;
                return response()->json(['success' => $success,], 200); 
            } 
            else{ 
                return response()->json(['error'=>'Unauthorised'], 401); 
            }
    }
}
