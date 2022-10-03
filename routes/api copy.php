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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Route::post('/register', 'App\Http\Controllers\UserController@register');
Route::post('/register', 'UserController@register');
// Route::post('login', 'App\Http\Controllers\UserController@authenticate');
Route::post('/login', 'UserController@authenticate');

// App\Http\Controllers\app\Http\Controllers\UserController does not exist


Route::group(['middleware' => ['jwt.verify']], function() {
    // Route::post('user','App\Http\Controllers\UserController@getAuthenticatedUser');
    Route::post('/user','UserController@getAuthenticatedUser');
});

// Route::group(['middleware' => ['cors']], function () {
//     //Rutas a las que se permitirá acceso
//     Route::post('/login','UserController@getAuthenticatedUser');
// });

// Tutorial y ejemplo de Laravel 8 CORS
// https://www.instintoprogramador.com.mx/2020/10/tutorial-y-ejemplo-de-laravel-8-cors.html


// https://www.nigmacode.com/laravel/solucionar-cors-en-laravel/
