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
    Route::get('attributes', 'AttributeController@index');

    Route::group(['middleware' => 'auth'], function () {

        Route::post('logout', 'AuthController@logout');

        Route::get('user', function (\Illuminate\Http\Request $request) {
            return response()->json($request->user());
        });

        Route::apiResource('attributes', 'AttributeController', [
            'except' => ['index'],
        ]);

        Route::apiResource('projects', 'ProjectController', [
            'except' => ['index', 'show'],
        ]);
    });

});

Route::get('/{any?}', function () {
    return view('home');
})->where('any', '.*');
