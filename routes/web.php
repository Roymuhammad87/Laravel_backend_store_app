<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PictureController;
use App\Http\Controllers\Api\PasswordController;
use App\Http\Controllers\Api\LoginLogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ToolController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//Reset paswword
Route::get('/reset-password', [PasswordController::class, 'resetPasswordLoad'])->name('users.reset');
Route::post('/reset-password/{userId}', [PasswordController::class, 'resetPassword'])->name('users.resetpassword');


//Verfiy Email

Route::get('verify-email', [LoginLogoutController::class, 'emailVerification']);



    Route::get('/add-new-picture', [ToolController::class, 'create'])->prefix('pictures')->name('pictures.create');
    Route::post('/add-new-picture', [ToolController::class, 'store'])->name('pictures.store');


    //profile
    Route::get('profile/update', [ProfileController::class, 'show']);
    Route::put('/profile/{profileId}/update-user-info', [ProfileController::class,'update'])
    ->name('profile.update');
