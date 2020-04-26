<?php

declare(strict_types=1);

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

Route::post('login', 'Api\UserController@login');

Route::middleware('auth:sanctum')->group(function () {
    Route::get('logout', 'Api\UserController@logout');
    Route::get('/user', 'Api\UserController@get');
    Route::get('categories/all', 'Api\CategoryController@all');
    Route::get('products/all', 'Api\ProductController@all');
    Route::get('stakeholders/all', 'Api\StakeholderController@all');
    Route::get('invoices/all', 'Api\InvoiceController@all');
});

Route::name('api.')->middleware('auth:sanctum')->group(function () {
    Route::apiResource('invoices', 'Api\InvoiceController');
    Route::apiResource('orders', 'Api\OrderController');
    Route::apiResource('stakeholders', 'Api\StakeholderController');
    Route::apiResource('products', 'Api\ProductController');
    Route::apiResource('categories', 'Api\CategoryController');
    Route::apiResource('statuses', 'Api\StatusController');
    Route::apiResource('documentTypes', 'Api\DocumentTypeController');
});
