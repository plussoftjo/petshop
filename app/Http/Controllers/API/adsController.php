<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\ads;
use Auth;
use Image;
use Carbon\Carbon;
use Validator;
class adsController extends Controller
{
   	public function store(Request $req)
   	{
   		$validator = Validator::make($req->all(), [
            'image' => 'required|image64:jpeg,jpg,png',
            'title' => 'required',
            'place' => 'required',
            'des' => 'required',
            'place' => 'required'
         ]);
         
        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],401);
        }

         $imageData = $req->get('image');
         $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
         Image::make($req->get('image'))->resize(750,750)->save(public_path('images/ads/').$fileName);



   		$ads = ads::create([
   			'user_id' => Auth::id(),
   			'place' => $req->place,
   			'type' => $req->type,
   			'image' => 'images/ads/'.$fileName,
   			'title' => $req->title,
   			'des' => $req->des
   		]);
   	}

   	public function index()
   	{
   		return response()->json(ads::orderBy('id','desc')->get());
   	}

   	public function show($id)
   	{
   		return response()->json(ads::where('id',$id)->firstOrFail());
   	}

      public function search(Request $req)
      {
         if($req->type == 'جميع الاقسام')
         {
           return response()->json(ads::orderBy('id','desc')->get());
         }else {
           return response()->json(ads::where('type', $req->type)->orderBy('id','desc')->get());
         }
        
      }
}
