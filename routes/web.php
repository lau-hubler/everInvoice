<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

// Localization and translation for vue
Route::get('js/lang-{locale}.js', 'LanguageController@set' )->name('assets.lang');

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('invoices/{invoice}/pay', 'TransactionController@pay');
Route::get('invoices/{invoice}/refresh', 'TransactionController@consultTransaction');
Route::get('invoices/return', 'TransactionController@paymentResponse');

Route::middleware('auth')->group(function () {
    Route::apiResource('categories', 'CategoryController')->only('index');
    Route::apiResource('products', 'ProductController')->only('index');
    Route::apiResource('stakeholders', 'StakeholderController')->only('index');
    Route::apiResource('invoices', 'InvoiceController')->only('index');
    Route::post('invoices/import', 'InvoiceController@import')->name('invoices.import');
    Route::post('invoices/export', 'InvoiceController@export')->name('invoices.export');
    Route::resource('roles', 'RoleController');
});



