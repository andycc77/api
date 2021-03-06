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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function ($api) {
    $api->group(['namespace' => 'App\Api\Controllers'], function ($api) {
        $api->post('user/login','AuthController@authenticate');
        $api->post('user/register','AuthController@register');
        $api->group(['middleware' => 'jwt.auth'], function ($api) {
            $api->get('user/me','AuthController@getAuthenticatedUser');
            $api->resource('lessons','LessonsController');
            $api->post('/lessons/images','LessonsController@images');
            $api->post('lessons/{id}','LessonsController@update');
        });
    });
});