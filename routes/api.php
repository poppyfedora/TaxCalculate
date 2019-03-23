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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/api-token/generate', function (){
    $key = env('API_TOKEN');
    $key = md5($key);
    return $key;
});

Route::group(['prefix' => 'tax', 'middleware' => 'auth-api'], function (){
    Route::post('/calculate',  'TaxController@calculate');
});