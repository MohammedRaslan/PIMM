<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use \Illuminate\Session\Store;
use Illuminate\Support\Facades\Session;

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
    return view('admin.login');
});

Route::post('/login', [AdminController::class,'login'])->name('login');

    Route::get('/home',[AdminController::class, 'Home'])->name('home');



Route::get('counter',[AdminController::class,'counter']);


Route::get('data', [AdminController::class, 'data']);

Route::post('editInfo', [AdminController::class, 'editInfo']);

Route::get('setting',[AdminController::class, 'settings']);

