<?php

use Illuminate\Http\Request;
use CloudCreativity\LaravelJsonApi\Facades\JsonApi;

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

JsonApi::register('v1')->routes(function ($api) {
    $api->resource('users')->relationships(function ($relations) {
        $relations->hasOne('profile');
    });
    $api->resource('profiles')->relationships(function ($relations) {
        $relations->hasOne('education');
        $relations->hasOne('family');
    });
    $api->resource('education')->id('[\d]+');;
    $api->resource('families')->id('[\d]+');;
});
