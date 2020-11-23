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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

//-------------------------------------ROUTES FOR USER------------------------------------------\\
Route::get('/users', 'UserController@indexApi');
Route::post('/users/{user}/save', 'UserController@storeApi');
Route::get('/users/{user}', 'UserController@showApi');
Route::post('/users/updatePassword/{user}', 'UserController@updatePasswordApi');
Route::post('/users/updateUserDetails/{user}', 'UserController@updateUserDetailsApi');
Route::post('/users/updateUserImage/{user}', 'UserController@updateImageApi');
Route::delete('/users/{user}', 'UserController@destroyApi');
//-----------------------------------------------------------------------------------------------\\


