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

Route::group(['prefix' => 'api'], function () {

    Route::post('auth', 'AuthController@login');

    Route::get('projects', 'ProjectController@index');
    Route::get('projects/{project}', 'ProjectController@show');
    Route::get('attributes', 'AttributeController');

    Route::group(['middleware' => 'auth'], function () {

        Route::post('logout', 'AuthController@logout');

        Route::get('user', 'UserController');

        Route::apiResource('projects', 'ProjectController', [
            'except' => ['index', 'show'],
        ]);
    });
});

Route::view('/{any?}','home')
    ->where('any', '.*');
