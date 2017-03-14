<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::any('admin/login', 'Admin\LoginController@login');
    Route::get('admin/code','Admin\LoginController@code');

});


Route::group(['middleware' => ['web','admin.login'], 'prefix'=>'admin', 'namespace'=>'Admin'], function () {
    Route::get('index','IndexController@index');
    Route::get('info','IndexController@info');
    Route::any('pass', 'IndexController@pass');
    Route::get('quit','LoginController@quit');

    //资源路由
    Route::resource('category','CategoryController');
    Route::resource('article', 'ArticleController');
//    Route::get('cate/index','CategoryController@index');
    Route::post('cate/changeorder', 'CategoryController@changeOrder');

    Route::any('upload', 'CommonController@upload');

});