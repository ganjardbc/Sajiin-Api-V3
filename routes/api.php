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
    // admin
    Route::prefix('admin')->group(function () {
        // auth
        Route::get('me', 'AuthAdminController@me');
        Route::post('logout', 'AuthAdminController@logout');

        // crud
        Route::get('getAll', 'AdminController@getAll');
        Route::get('getByID', 'AdminController@getByID');
        Route::post('changePassword', 'AdminController@changePassword');
        Route::post('uploadImage', 'AdminController@uploadImage');
        Route::post('removeImage', 'AdminController@removeImage');
        Route::post('post', 'AdminController@post');
        Route::put('update', 'AdminController@update');
        Route::delete('delete', 'AdminController@delete');
    });

    // bizpars
    Route::prefix('bizpar')->group(function () {
        Route::get('getAll', 'BizparController@getAll');
        Route::get('getByType', 'BizparController@getByType');
        Route::get('getByKey', 'BizparController@getByKey');
        Route::post('post', 'BizparController@post');
        Route::put('update', 'BizparController@update');
        Route::delete('delete', 'BizparController@delete');
    });

    // role
    Route::prefix('role')->group(function () {
        Route::get('getAll', 'RoleController@getAll');
        Route::get('getByID', 'RoleController@getByID');
        Route::post('post', 'RoleController@post');
        Route::put('update', 'RoleController@update');
        Route::delete('delete', 'RoleController@delete');
    });

    // permission
    Route::prefix('permission')->group(function () {
        Route::get('getAll', 'PermissionController@getAll');
        Route::get('getByID', 'PermissionController@getByID');
        Route::post('post', 'PermissionController@post');
        Route::put('update', 'PermissionController@update');
        Route::delete('delete', 'PermissionController@delete');
    });

    // role permission
    Route::prefix('rolepermission')->group(function () {
        Route::get('getAll', 'RolePermissionController@getAll');
        Route::post('checkRolePermission', 'RolePermissionController@checkRolePermission');
        Route::post('post', 'RolePermissionController@post');
        Route::put('update', 'RolePermissionController@update');
        Route::delete('delete', 'RolePermissionController@delete');
    });

    // merchant
    Route::prefix('merchant')->group(function () {
        Route::get('getAll', 'MerchantController@getAll');
        Route::get('getByID', 'MerchantController@getByID');
        Route::post('uploadImage', 'MerchantController@uploadImage');
        Route::post('removeImage', 'MerchantController@removeImage');
        Route::post('post', 'MerchantController@post');
        Route::put('update', 'MerchantController@update');
        Route::delete('delete', 'MerchantController@delete');
    });

    // position
    Route::prefix('position')->group(function () {
        Route::get('getAll', 'PositionController@getAll');
        Route::get('getByID', 'PositionController@getByID');
        Route::post('post', 'PositionController@post');
        Route::put('update', 'PositionController@update');
        Route::delete('delete', 'PositionController@delete');
    });

    // employee 
    Route::prefix('employee')->group(function () {
        Route::get('getAll', 'EmployeeController@getAll');
        Route::get('getByID', 'EmployeeController@getByID');
        Route::post('uploadImage', 'EmployeeController@uploadImage');
        Route::post('removeImage', 'EmployeeController@removeImage');
        Route::post('post', 'EmployeeController@post');
        Route::put('update', 'EmployeeController@update');
        Route::delete('delete', 'EmployeeController@delete');
    });

    // user
    Route::prefix('user')->group(function () {
        // auth
        Route::get('me', 'AuthController@me');
        Route::post('logout', 'AuthController@logout');

        // crud
        Route::get('getAll', 'UserController@getAll');
        Route::get('getByID', 'UserController@getByID');
        Route::post('uploadImage', 'UserController@uploadImage');
        Route::post('removeImage', 'UserController@removeImage');
        Route::post('changePassword', 'UserController@changePassword');
        Route::post('post', 'UserController@post');
        Route::put('update', 'UserController@update');
        Route::delete('delete', 'UserController@delete');
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
});

Route::prefix('authAdmin')->group(function () {
    Route::post('login', 'AuthAdminController@login');
});

