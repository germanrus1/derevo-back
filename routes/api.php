<?php

use App\Http\Controllers\API\TreeController;
use App\Http\Controllers\API\TreeItemController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\RegisterController;
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
Route::post('register', [RegisterController::class, 'register']);

Route::middleware('auth:api')->group( function () {
    Route::resource('user', UserController::class);
    Route::resource('tree', TreeController::class);
    Route::get('treeItem/list/{id}/', 'App\Http\Controllers\API\TreeItemController@treeItemList');
    Route::resource('treeItem', TreeItemController::class);
});
