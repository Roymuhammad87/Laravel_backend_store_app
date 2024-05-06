<?php

namespace App\Http\Controllers;

use ApiResponse;
use App\Models\Tool;
use App\Models\User;
use App\Models\Picture;
use Illuminate\Support\Str;
use App\Http\Resources\ToolResource;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\StoreToolRequest;
use App\Http\Requests\UpdateToolRequest;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules\In;

class ToolController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {

        $tools = Tool::select('*')->where('state','1')->orderBy('created_at', 'desc')->get();

        return ApiResponse::apiResponse(200, 'Tools retrieved successfully', ToolResource::collection($tools));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreToolRequest  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(StoreToolRequest $request)   {

    //     $validatedData = $request->validated();

    //      if($validatedData['user_id'] == auth()->user()->id){

    //        $tool = Tool::create([
    //         'name'=>$validatedData['name'],
    //         'description'=>$validatedData['description'],
    //         'price'=>$validatedData['price'],
    //         'state'=>$validatedData['state'],
    //         'user_id'=>$validatedData['user_id'],
    //         'category_id'=>  Category::where('name', $validatedData['categoryName'])->first()->id,
    //         'images'=>$validatedData['images'],
    //         'created_at'=>now(),
    //         'updated_at'=>now()

    //        ]);
    //      } else {
    //         return ApiResponse::apiResponse(400, 'You are not authorized to create a tool');
    //      }
    //         $slug = Str::slug($tool->name, '-');
    //         if($request->hasFile('images')){
    //             $files = $request->file('images');
    //             foreach($files as $file){
    //                 $name = uniqid().'-'.$slug.'.'.$file->getClientOriginalExtension();
    //                 $path = "uploads/tools/";
    //                 $file->move(public_path($path), $name);
    //                  Picture::create([
    //                     'path'=>$path.$name,
    //                     'tool_id'=>$tool->id,
    //                     'created_at'=>now(),
    //                     'updated_at'=>now()
    //                 ]);
    //             }
    //            return ApiResponse::apiResponse(201, 'Tool created succefully', new ToolResource($tool));
    //         } else {
    //         return ApiResponse::apiResponse(400, 'Tool created succefully but no images uploaded');
    //         }

    // }

   
    public function show(int $toolId)  {

        $tool = Tool::FindOrFail($toolId);
        return ApiResponse::apiResponse(200,'Tool retrieved successfully', new ToolResource($tool));

    }

    public function edit(Tool $tool) {

        //
    }
    public function update(UpdateToolRequest $request, int $toolId)  {
         $tool = Tool::FindOrFail($toolId);
        $updatedData= $request->validated();
      
      if($tool != null){
            $userId = auth()->user()->id;
          if($tool->user_id != $userId){
            return ApiResponse::apiResponse(400, 'You are not authorized to updste the tool');
          } else {
             if($tool->update([
            'name'=>$updatedData['name'],
            'description'=>$updatedData['description'],
            'price'=>$updatedData['price'],
            'state'=>$updatedData['state'],
            'category_id'=>  Category::where('name', $updatedData['categoryName'])->first()->id,
            'updated_at'=>now()
            ])) {
             return ApiResponse::apiResponse(200,'Tool updated successfully', ['tool'=>$tool]);
            } else {
            return ApiResponse::apiResponse(400,'Some thing went wrong');
            } 
         }  

        } else {
            return ApiResponse::apiResponse(400, 'Tool not found');
        }
        
    }

   
    public function destroy(Tool $tool) {

        
    }




    //Get user tools
    public function getUserTools($userId) {

         $user = User::where('id', $userId)->first();
         if($user) {
            if($user->id == auth()->user()->id){

             $tools = $user->tools;
                if(count($tools) ) {
                    return ApiResponse::apiResponse(200, 'user Tools retrieved successfully', ToolResource::collection($tools));
                } else {
                    return ApiResponse::apiResponse(200, 'No tools found for this user', []);
                }
             } else {

            return ApiResponse::apiResponse(401, 'Unauthorized', []);
            }
         } else {

            return ApiResponse::apiResponse(200, 'User not found', []);

         }
    }
}
