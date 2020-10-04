<?php

use Illuminate\Support\Facades\Route;

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
    return view('home');
});

Auth::routes();
Route::get('register-step2', 'App\Http\Controllers\Auth\RegisterStep2Controller@showForm');
Route::post('register-step2', 'App\Http\Controllers\Auth\RegisterStep2Controller@postForm')->name('register.step2');



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/userhome', function(){
    return view('user-home');
});

Route::get('/chooseproducts',function(){
    return view('choose-products');
});

Route::get('/choosecategories', function(){
    return view('choose-categories');
});

Route::post('/products', function(){
    return view('products');
});

Route::post('/selectedproducts', function(){
    return view('selected-products');
});

Route::get('/group/join', [App\Http\Controllers\GroupController::class, 'join'])->name('group.join');

Route::post('/group/search', [App\Http\Controllers\GroupController::class, 'search'])->name('group.search');

Route::resource('group', 'App\Http\Controllers\GroupController');

Route::post('send-notification', [App\Http\Controllers\NotificationController::class, 'sendJoinRequestNotification']);




