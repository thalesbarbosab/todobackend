<?php

use Illuminate\Http\Request;

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
Route::get('/', function () {
    return view('welcome');
});
Route::resource('/tasks','TaskController');
Route::put('/tasks/{task}/status', 'TaskController@changeStatus');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
