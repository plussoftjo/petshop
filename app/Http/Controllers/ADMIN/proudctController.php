<?php

namespace App\Http\Controllers\ADMIN;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use Carbon\Carbon;
use Validator;
use App\proudct;
use App\moreImage;
class proudctController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(proudct::get());
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
            'title' => 'required',
            'weight' => 'required',
            'des' => 'required',
            'price' => 'required',
            'catg' => 'required',
         ]);

        if($validator->fails())
        {
            return response()->json(['errors' => $validator->errors()],401);
        }

        $imageData = $request->get('image');
        $fileName = Carbon::now()->timestamp . '_' . uniqid() . '.' . explode('/', explode(':', substr($imageData, 0, strpos($imageData, ';')))[1])[1];
        Image::make($request->get('image'))->resize(650,750)->save(public_path('images/proudct/').$fileName);
        $proudct = proudct::create([
            'title' => $request->title,
            'weight' => $request->weight,
            'des' => $request->des,
            'price' => $request->price,
            'catg' => $request->catg,
            'image' => 'images/proudct/'.$fileName,
        ]);

        return response()->json(['id' => $proudct->id],200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(proudct::where('id',$id)->firstOrFail());
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
        proudct::where('id',$id)->update([
            'title' => $request->title,
            'weight' => $request->weight,
            'price' => $request->price,
            'des' => $request->des,
            'catg' => $request->catg
        ]);
    }

    public function updateImage(Request $request, $id)
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
        Image::make($request->get('image'))->resize(650,750)->save(public_path('images/proudct/').$fileName);

        proudct::where('id',$id)->update(['image' => 'images/proudct/'. $fileName]);

        return response()->json(['image' => 'images/proudct/' . $fileName]);

    }

    public function moreImage(Request $request, $id)
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
        Image::make($request->get('image'))->resize(650,750)->save(public_path('images/moreImage/').$fileName);

       $mi =  moreImage::create(['proudct_id' => $id, 'image' => 'images/moreImage/'.$fileName]);
        return response()->json(['image' => 'images/moreImage/' . $fileName,'id' => $mi->id]);
    }

    public function deleteImage($id)
    {
        moreImage::where('id',$id)->delete();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        proudct::where('id',$id)->delete();
    }
}
