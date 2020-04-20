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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('login', 'Api\UserController@login');

Route::name('api.')->group(function () {
    Route::apiResource('invoices', 'Api\InvoiceController');
    Route::apiResource('orders', 'Api\OrderController');
    Route::apiResource('stakeholders', 'Api\StakeholderController');
    Route::apiResource('products', 'Api\ProductController');
    Route::apiResource('categories', 'Api\CategoryController');
    Route::apiResource('statuses', 'Api\StatusController');
    Route::apiResource('documentTypes', 'Api\DocumentTypeController');
});
