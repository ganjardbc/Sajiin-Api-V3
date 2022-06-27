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

    // payment
    Route::prefix('payment')->group(function () {
        Route::get('getAll', 'PaymentController@getAll');
        Route::get('getByID', 'PaymentController@getByID');
        Route::post('post', 'PaymentController@post');
        Route::post('uploadImage', 'PaymentController@uploadImage');
        Route::post('removeImage', 'PaymentController@removeImage');
        Route::put('update', 'PaymentController@update');
        Route::delete('delete', 'PaymentController@delete');
    });

    // shipment
    Route::prefix('shipment')->group(function () {
        Route::get('getAll', 'ShipmentController@getAll');
        Route::get('getByID', 'ShipmentController@getByID');
        Route::post('post', 'ShipmentController@post');
        Route::post('uploadImage', 'ShipmentController@uploadImage');
        Route::post('removeImage', 'ShipmentController@removeImage');
        Route::put('update', 'ShipmentController@update');
        Route::delete('delete', 'ShipmentController@delete');
    });

    // category
    Route::prefix('category')->group(function () {
        Route::get('getAll', 'CategoryController@getAll');
        Route::get('getByID', 'CategoryController@getByID');
        Route::post('post', 'CategoryController@post');
        Route::put('update', 'CategoryController@update');
        Route::delete('delete', 'CategoryController@delete');
    });

    // product
    Route::prefix('product')->group(function () {
        Route::get('getAll', 'ProductController@getAll');
        Route::get('getByID', 'ProductController@getByID');
        Route::post('post', 'ProductController@post');
        Route::put('update', 'ProductController@update');
        Route::delete('delete', 'ProductController@delete');
    });

    // product image
    Route::prefix('productImage')->group(function () {
        Route::get('getAll', 'ProductImageController@getAll');
        Route::get('getByID', 'ProductImageController@getByID');
        Route::post('post', 'ProductImageController@post');
        Route::put('update', 'ProductImageController@update');
        Route::delete('delete', 'ProductImageController@delete');
    });

    // store
    Route::prefix('store')->group(function () {
        Route::get('getAll', 'StoreController@getAll');
        Route::get('getByID', 'StoreController@getByID');
        Route::post('post', 'StoreController@post');
        Route::post('uploadImage', 'StoreController@uploadImage');
        Route::post('removeImage', 'StoreController@removeImage');
        Route::put('update', 'StoreController@update');
        Route::delete('delete', 'StoreController@delete');
    });

    // store table
    Route::prefix('storeTable')->group(function () {
        Route::get('getAll', 'StoreTableController@getAll');
        Route::get('getByID', 'StoreTableController@getByID');
        Route::post('post', 'StoreTableController@post');
        Route::post('uploadImage', 'StoreTableController@uploadImage');
        Route::post('removeImage', 'StoreTableController@removeImage');
        Route::put('update', 'StoreTableController@update');
        Route::delete('delete', 'StoreTableController@delete');
    });

    // store payment
    Route::prefix('storePayment')->group(function () {
        Route::get('getAll', 'StorePaymentController@getAll');
        Route::get('getByID', 'StorePaymentController@getByID');
        Route::post('post', 'StorePaymentController@post');
        Route::put('update', 'StorePaymentController@update');
        Route::delete('delete', 'StorePaymentController@delete');
    });

    // store shipment
    Route::prefix('storeShipment')->group(function () {
        Route::get('getAll', 'StoreShipmentController@getAll');
        Route::get('getByID', 'StoreShipmentController@getByID');
        Route::post('post', 'StoreShipmentController@post');
        Route::put('update', 'StoreShipmentController@update');
        Route::delete('delete', 'StoreShipmentController@delete');
    });

    // store product
    Route::prefix('storeProduct')->group(function () {
        Route::get('getAll', 'StoreProductController@getAll');
        Route::get('getByID', 'StoreProductController@getByID');
        Route::post('post', 'StoreProductController@post');
        Route::put('update', 'StoreProductController@update');
        Route::delete('delete', 'StoreProductController@delete');
    });

    // shift 
    Route::prefix('shift')->group(function () {
        Route::get('getAll', 'ShiftController@getAll');
        Route::get('getByID', 'ShiftController@getByID');
        Route::post('post', 'ShiftController@post');
        Route::put('update', 'ShiftController@update');
        Route::delete('delete', 'ShiftController@delete');
    });

    // employee shifts 
    Route::prefix('employeeShift')->group(function () {
        Route::get('getAll', 'EmployeeShiftController@getAll');
        Route::post('post', 'EmployeeShiftController@post');
        Route::delete('delete', 'EmployeeShiftController@delete');
    });

    // order
    Route::prefix('order')->group(function () {
        Route::get('getDashboard', 'OrderController@getDashboard');
        Route::get('getAll', 'OrderController@getAll');
        Route::get('getByID', 'OrderController@getByID');
        Route::get('getCountByID', 'OrderController@getCountByID');
        Route::get('getCountByStoreID', 'OrderController@getCountByStoreID');
        Route::get('getCountCustomerByID', 'OrderController@getCountCustomerByID');
        Route::post('post', 'OrderController@post');
        Route::post('postOrderStatus', 'OrderController@postOrderStatus');
        Route::post('postOrderPaymentStatus', 'OrderController@postOrderPaymentStatus');
        Route::post('postCustomer', 'OrderController@postCustomer');
        Route::post('postAdmin', 'OrderController@postAdmin');
        Route::put('update', 'OrderController@update');
        Route::delete('delete', 'OrderController@delete');
    });

    // orderItem
    Route::prefix('orderItem')->group(function () {
        Route::get('getAll', 'OrderItemController@getAll');
        Route::get('getByID', 'OrderItemController@getByID');
        Route::get('getAllByStoreID', 'OrderItemController@getAllByStoreID');
        Route::get('getAllByEmployeeID', 'OrderItemController@getAllByEmployeeID');
        Route::post('post', 'OrderItemController@post');
        Route::put('update', 'OrderItemController@update');
        Route::delete('delete', 'OrderItemController@delete');
    });

    // customers
    Route::prefix('customer')->group(function () {
        Route::get('getAll', 'CustomerController@getAll');
        Route::get('getByID', 'CustomerController@getByID');
        Route::post('uploadImage', 'CustomerController@uploadImage');
        Route::post('removeImage', 'CustomerController@removeImage');
        Route::post('post', 'CustomerController@post');
        Route::put('update', 'CustomerController@update');
        Route::delete('delete', 'CustomerController@delete');
    });

    // address
    Route::prefix('address')->group(function () {
        Route::get('getAll', 'AddressController@getAll');
        Route::get('getByID', 'AddressController@getByID');
        Route::post('post', 'AddressController@post');
        Route::put('update', 'AddressController@update');
        Route::delete('delete', 'AddressController@delete');
    });

    // wish lists
    Route::prefix('wishlist')->group(function () {
        Route::get('getAll', 'WishListController@getAll');
        Route::post('checkWishList', 'WishListController@checkWishList');
        Route::post('post', 'WishListController@post');
        Route::put('update', 'WishListController@update');
        Route::delete('delete', 'WishListController@delete');
    });

    // cart
    Route::prefix('cart')->group(function () {
        Route::get('getAll', 'CartController@getAll');
        Route::get('getByID', 'CartController@getByID');
        Route::get('getCountByID', 'CartController@getCountByID');
        Route::post('post', 'CartController@post');
        Route::put('update', 'CartController@update');
        Route::delete('delete', 'CartController@delete');
    });
});

Route::prefix('auth')->group(function () {
    Route::post('login', 'AuthController@login');
});

Route::prefix('authAdmin')->group(function () {
    Route::post('login', 'AuthAdminController@login');
});

