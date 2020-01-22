<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');



Route::namespace('Admin')->prefix('admin')->name('admin.')->middleware('can:manage-users')->group(function (){

    Route::Resource('/users' ,'UserController', ['except' => ['show','create','store']]);
});



//Route::Resource('/admin/users' ,'Admin\UserController', ['except' => ['show','create','store']]);
//Route::namespace('Admin')->prefix('admin')->name('admin.')->group(function (){});
