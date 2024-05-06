<?php

namespace App\Http\Controllers;

use ApiResponse;
use App\Models\Picture;
use Illuminate\Http\Request;
use App\Http\Requests\StorePictureRequest;
use App\Http\Requests\UpdatePictureRequest;
use App\Models\Tool;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PictureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePictureRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePictureRequest $request) {

        $validatedData = $request->validated();
       
        if($request->hasFile('path')){
            $files = $request->file('path');
            $data= [];
            foreach($files as $file){
                $name = uniqid().time().$file->extension();
                $path = "uploads/tools";
                
                $file->move($path, $name);
                $picture = Picture::create([
                    'path'=>$path.$name,
                    'tool_id'=>$validatedData['tool_id'],
                    'created_at'=>now(),
                ]);
                array_push($data, $picture->path);
            }

            return ApiResponse::apiResponse(201, 'Tool images added successfuly',$data );
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function show(Picture $picture)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function edit(Picture $picture)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePictureRequest  $request
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $pictureId)    {

        $picture = Picture::findOrFail($pictureId);
        
        // $updatedData = $request->validate([
        //    'image'=>'required|file|image|mimes:png,jpg, jpeg'
        // ]);
        //  dd($updatedData);
        $tool_id = $picture->tool_id;
        $tool = Tool::where('id', $tool_id)->first();
            if(File::exists($picture->path)) {
                File::delete($picture->path);
            }
            if($request->hasFile('image')){
                 $file = $request->image;
                
                 $slug = Str::slug($tool->name, '-');
                 dd($slug);
                 $name = uniqid().'-'.$slug.'-'.$file->extension();
                 $path = 'uploads/tools/';
                 $file->move($path, $name);
                 if($picture->update([
                    'tool_id'=>$tool_id,
                    'path'=>$path.$name
                 ])){
                   return ApiResponse::apiResponse(200, 'Tool updated Successfully', ['picture'=>$picture]);
        
                 } else {
                    return  ApiResponse::apiResponse(400, 'Some thing went wrong', []);
                 }
            }
       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Picture  $picture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Picture $picture)
    {
        //
    }
}
