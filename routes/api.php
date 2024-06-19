<?php

use App\Http\Controllers\ProductsTypeController;
use App\Http\Controllers\UserController;
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

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'getAll');
    Route::get('/users/{id}', 'getById');
    Route::post('/users', 'create');
    Route::put('/users/{id}', 'updateById');
    Route::delete('/users/{id}', 'deleteById');
});

Route::controller(ProductsTypeController::class)->group(function () {
    Route::post('/productsType', 'create');
    Route::get('/productsType', 'getAll');
    Route::get('/productsType/{id}', 'getById');
    Route::put('/productsType/{id}', 'updateById');
    Route::delete('/productsType/{id}', 'deleteById');
});
