<?php

namespace App\Http\Controllers;

use ApiResponse;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use App\Http\Resources\ProfileResource;
use App\Http\Requests\StoreProfileRequest;
use App\Http\Requests\UpdateProfileRequest;

class ProfileController extends Controller{


    public function index(int $userId)  {

        $profile = Profile::where('user_id', $userId)->first();
        if($profile != null){
             return ApiResponse::apiResponse(200, "Profile retrieved successfully",
          new ProfileResource($profile));
        } else {
            return ApiResponse::apiResponse(404, "Profile not found", []);
        }
    }

    public function store(StoreProfileRequest $request)  {

        $data = $request->validated();
        if($data['user_id'] != auth()->user()->id){
            return ApiResponse::apiResponse(401, "Unauthorized", null);
        } else {

            $profile = Profile::where('user_id', $data['user_id'])->first();
            if($profile == null){

             $user = User::findOrFail( $data['user_id']);
             
            $file = $request->image;
            if($file){
                $fileName = uniqid().'-'.Str::slug($user->fullName,'-').'.'.$file->extension();
                $filePath = 'uploads/users/';
                $file->move($filePath, $fileName);
                $image  =  $filePath.$fileName;
            }
            $profile = Profile::create([
                'user_id' => $data['user_id'],
                'image' => $image ?? null,
                'phone' => $data['phone'],
                'longitude' => $data['longitude'],
                'latitude' => $data['latitude'],
            ]);
            if($profile) {
                return ApiResponse::apiResponse(201, "Profile created suuccessfully",
                 new ProfileResource($profile));
            } else {
                return ApiResponse::apiResponse(400, "Profile not created");
            }
            }else {
                return ApiResponse::apiResponse(400, "Profile already created");
            }

        }


    }

    public function show(){
        return view('users.profile');
    }


    public function update(UpdateProfileRequest $request, int $profileId) {
   

        $profile = Profile::where('id', $profileId)->first();
        if ($profile != null) {
            $userId = $profile->user_id;
        } else {
            return ApiResponse::apiResponse(400, "No such profile found");
        }
        $validatedData = $request->validated();
        $user = User::findOrFail($userId);
        $file = $request->image;
        if ($file) {
            $fileName = uniqid() . '-' . Str::slug($user->name, '-') . '.' . $file->extension();
            $filePath = 'uploads/users/';
            $file->move($filePath, $fileName);
            $image  =  $filePath . $fileName;
        }
        $validatedData['image'] = $image;

        if ($profile->update($validatedData)) {

            return ApiResponse::apiResponse(200, "updated successfully", new ProfileResource($profile));
        } else {
            return ApiResponse::apiResponse(400, "Some thing went Wrong");
        }

    }


    public function destroy(Profile $profile)   {

    
    }
}
