<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\catg;
use Image;
use Carbon\Carbon;
use Validator;
class catgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(catg::get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image64:jpeg,jpg,png',
         ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],401);
        }

        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->resize(750,750)->save(public_path('images/catg/').$fileName);

        catg::create(['image' => 'images/catg/'.$fileName, 'title' => $request->title]);
        return response()->json('ok',200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        catg::where('id',$id)->update(['title' => $request->title]);
    }

    public function updateImage(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image64:jpeg,jpg,png',
         ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],401);
        }

        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->resize(750,750)->save(public_path('images/catg/').$fileName);

        catg::where('id',$id)->update(['image' => 'images/catg/'.$fileName]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        catg::where('id',$id)->delete();
    }
}
