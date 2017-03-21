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

Route::get('/', 'FrameController@index');
Route::post('process', 'FrameController@processImage');
Route::get ('download', 'FrameController@downloadImage');

Route::group(['prefix' => 'admin', 'namespace' => 'Admin' ], function (){
    Route::get ('login', 'LoginController@showLoginForm' )->name('login');
    Route::post('login', 'LoginController@login' );
    Route::group(['middleware' => 'auth'], function (){
        Route::get ('logout', 'LoginController@logout' )->name('logout');
        Route::get ('/', 'DashboardController@index');
        Route::get ('account', 'AccountController@index');
        Route::post('account', 'AccountController@save');
        Route::get ('frame', 'FrameController@index');
        Route::post('frame/list_process', 'FrameController@listProcess');
        Route::get ('frame/add', 'FrameController@showFormAdd');
        Route::post('frame/add', 'FrameController@create');
        Route::get ('frame/edit/{id}', 'FrameController@showFormEdit');
        Route::post('frame/edit/{id}', 'FrameController@update');
        Route::get ('frame/delete/{id}', 'FrameController@delete');
        Route::get ('avatar', 'AvatarController@index');
        Route::post('avatar/list_process', 'AvatarController@listProcess');
        Route::get ('user', 'UserController@index');
        Route::post('user/list_process', 'UserController@listProcess');
        Route::get ('user/add', 'UserController@showFormAdd');
        Route::post('user/add', 'UserController@create');
    });
});