<?php

use App\Http\Controllers\API\MainController;
use App\Http\Controllers\API\RegisterController;
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
//header('Access-Control-Allow-Origin: *');
//header('Access-Control-Allow-Methods: *');
//header('Access-Control-Allow-Headers: *');

//Route::get('/', [MainController::class, 'index']);
Route::post('register', [RegisterController::class, 'register']);

Route::middleware('auth:api')->group( function () {
    Route::resource('main', MainController::class);
//    Route::resource('products', 'API\ProductController');
});
