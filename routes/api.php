<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::post('create_tag','App\Http\Controllers\TagsController@add_tag'); 
Route::get('get_tags','App\Http\Controllers\TagsController@get_tags'); 
Route::post('edit_tag','App\Http\Controllers\TagsController@edit_tag');
Route::post('delete_tag','App\Http\Controllers\TagsController@delete_tag'); 

Route::post('upload','App\Http\Controllers\CategoryController@upload');
Route::post('delete_image','App\Http\Controllers\CategoryController@delete_image');
Route::post('create_category','App\Http\Controllers\CategoryController@create_category'); 
Route::get('get_categories','App\Http\Controllers\CategoryController@get_categories'); 
Route::post('edit_category','App\Http\Controllers\CategoryController@edit_category');
Route::post('delete_category','App\Http\Controllers\CategoryController@delete_category');   
