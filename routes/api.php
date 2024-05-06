<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\RegisterConttroller;
use App\Http\Controllers\Api\LoginLogoutController;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\ProfileController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//User auth


Route::prefix('users')->group(function () {
    Route::post('/register-new-user', RegisterConttroller::class); //register new user
    Route::post('/login', [LoginLogoutController::class, 'login']); //login
});
Route::delete('/logout', [LoginLogoutController::class, 'logout'])->middleware('auth:sanctum'); //logout



//verification and password resets

Route::post('/users/verify-your-email/{email}', [LoginLogoutController::class, 'verifyEmailAddress'])->middleware('auth:sanctum');
Route::post('/users/forget-password', [PasswordController::class, 'forgetPassword']);

//Categories model

Route::prefix('categories')->controller(CategoryController::class)->group(function () {

    Route::get('/', 'index');
    Route::post('/add-new-category', 'store');
    Route::put('/edit-category/{id}', 'update');
    Route::delete('/delete-category/{id}', 'destroy');
});

//Tool Model Routes

Route::prefix('tools')
    ->middleware('auth:sanctum')
    ->controller(ToolController::class)
    ->group(function () {
        Route::get('/', 'index');
        Route::get('/show-tool/{toolId}', 'show');
        Route::post('/add-new-tool', 'store');
        Route::put('/update-tool/{toolId}', 'update');
        Route::delete('/delete-tool/{id}', 'destroy');

        //Get user tool
        Route::get('/{userId}/user-tools', 'getUserTools');
    });


//Profile

Route::prefix('profile')->controller(ProfileController::class)
    ->middleware('auth:sanctum')->group(function () {
        Route::get('/{userId}', 'index');
        Route::post('/save-user-info', 'store');
        Route::put('/{profileId}/update-user-info', 'update');
    });


    //Pictures
    Route::prefix('pictures')->controller(PictureController::class)
    ->middleware('auth:sanctum')->group(function(){

        Route::put('/update-image/{pictureId}', 'update');
    });
