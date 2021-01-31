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
Route::post('api/create_tag','App\Http\Controllers\TagsController@add_tag'); 
Route::get('api/get_tags','App\Http\Controllers\TagsController@get_tags'); 
Route::post('api/edit_tag','App\Http\Controllers\TagsController@edit_tag');
Route::post('api/delete_tag','App\Http\Controllers\TagsController@delete_tag'); 

Route::post('api/upload','App\Http\Controllers\CategoryController@upload');

Route::get('/', function () {
    return view('welcome');
});
Route::any('{slug}', function () {
    return view('welcome');
});