<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::post('/addCategory','HomeController@postAddCategory');
Route::get('category/{id}','HomeController@getCategory');
Route::get('/addPost','PostController@getAddPost');
Route::get('/post/{id}','PostController@getPost');
Route::post('/addPost','PostController@postAddPost');
Route::get('/postEdit/{id}','PostController@getPostedit');
Route::post('/postEdit/{id}','PostController@postPostedit');
Route::post('/delete/{id}','PostController@postDelete');
