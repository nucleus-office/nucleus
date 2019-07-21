<?php

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

// Public owner registration
Route::post('login', 'AuthController@issueToken')->middleware('api');
Route::post('logout', 'AuthController@revokeToken')->middleware('auth:api');

Route::group([
    'middleware' => 'auth:api',
], function () {
    Route::apiResource('users', 'UserController');

    Route::get('email/verify', 'VerificationController@show')->name('verification.notice');
    Route::get('email/verify/{uuid}', 'VerificationController@verify')->name('verification.verify');
    Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
});
