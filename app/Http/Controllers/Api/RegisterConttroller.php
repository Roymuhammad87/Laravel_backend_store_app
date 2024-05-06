<?php

namespace App\Http\Controllers\Api;

use ApiResponse;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;

class RegisterConttroller extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(RegisterRequest $request) {

        $userData = $request->validated();
        

        

        $user = User::create([
            'fullName'=>$userData['fullName'],
            'email'=>$userData['email'],
            'password'=>bcrypt($userData['password']),
        ]);
        // $token = $user->createToken('auth_token')->plainTextToken;
        $data = [
            'id'=>$user->id,
            'fullName'=>$user->fullName,
            'email'=>$user->email,
            'password'=>bcrypt($user->password),

        ];
        if($user) {
            return ApiResponse::apiResponse(201, 'Account created successfully', $data);
        } else {
            return ApiResponse::apiResponse(422, 'Invalid credentials');
        }

      }
    }

