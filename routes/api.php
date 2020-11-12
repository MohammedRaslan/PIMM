<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ContactController;
use App\Http\Controllers\API\UserController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
],
    function ($router) {
    Route::post('register',[AuthController::class,'register']);
    Route::post('login',[AuthController::class,'login']);
    Route::post('logout',[AuthController::class,'logout']);
    Route::get('getprofile',[AuthController::class,'getProfile']);
});

Route::group([
    'middleware' => 'api',
    'prefix' => 'contacts'
],
    function ($router) {
    Route::get('/',[ContactController::class,'index']);
    Route::get('public',[ContactController::class,'publicContacts']);
    Route::post('private',[ContactController::class,'privateContacts']);
    Route::post('savecontact',[ContactController::class,'saveContact']);
    Route::get('contactCount',[ContactController::class, 'week_month']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'user'
],
    function ($router) {
    Route::get('profile',[UserController::class,'getprofile']);
    Route::post('updatestatus',[UserController::class,'updateStatus']);
    Route::get('qr',[UserController::class, 'getQr']);
    Route::post('player_id',[UserController::class, 'player_id']);
    Route::post('changepassword',[UserController::class,'changePassword']);
    Route::post('test',[UserController::class, 'test']);
});


