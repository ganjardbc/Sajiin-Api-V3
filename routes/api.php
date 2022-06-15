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

Route::middleware('auth:sanctum')->group(function () {
    // user
    Route::get('me', 'AuthController@me');
    Route::post('logout', 'AuthController@logout');

    // admin
    Route::prefix('admin')->group(function () {
        // auth
        Route::get('me', 'AuthAdminController@me');
        Route::post('logout', 'AuthAdminController@logout');

        // crud
        Route::get('getAll', 'AdminController@getAll');
        Route::get('getByID', 'AdminController@getByID');
        Route::post('changePassword', 'AdminController@changePassword');
        Route::post('post', 'AdminController@post');
        Route::put('update', 'AdminController@update');
        Route::delete('delete', 'AdminController@delete');
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
    Route::post('register', 'AuthController@register');
});

Route::prefix('authAdmin')->group(function () {
    Route::post('login', 'AuthAdminController@login');
});

