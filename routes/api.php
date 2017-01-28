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

$api = app('Dingo\Api\Routing\Router');
$api->version('v1', ['namespace' => 'App\Http\Controllers\api\v1'], function ($api) {
    $api->post('v1/auth/register', 'AuthController@register');
    $api->post('v1/auth/login', 'AuthController@login');
    $api->post('v1/auth/forgotpassword', 'AuthController@forgotPassword');
    $api->get('v1/activate/token/{token}', 'AuthController@checkActivateToken');
    $api->post('v1/activate/token', 'AuthController@activateToken');
    $api->group(['middleware' => 'auth:api'], function ($api) {
        $api->post('v1/change/password', 'ProfileController@changePassword');
        $api->get('v1/profiles', 'ProfileController@getProfileDetail');
        $api->patch('v1/profiles/{profileId}', 'ProfileController@updateProfile');
    });
});