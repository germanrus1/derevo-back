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
//var_dump(env('APP_URL').'/storage');die;
//Route::get('storage/{filename}', function ($filename)
//{
//    $path = storage_path('app/upload/' . $filename);
//
//    if (!File::exists($path)) {
//        abort(404);
//    }
//
//    $file = File::get($path);
//    $type = File::mimeType($path);
//
//    $response = Response::make($file, 200);
//    $response->header("Content-Type", $type);
//
//    return $response;
//});

//Route::get('/', function () {
//    return view('welcome');
//});
