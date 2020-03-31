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

Route::group([
    'namespace' => 'Auth'
], function () {
    Route::post('/register', 'RegisterController@main');
    Route::post('/login', 'LoginController@main');
});

Route::group([
    'middleware' => 'auth:api'
], function () {
    Route::group([
        'prefix' => 'groups',
        'namespace' => 'Groups'
    ], function () {
        Route::post('/create-group', 'CreateGroupController@main');
        Route::get('/by-invited-key', 'GetGroupByInvitedKeyController@main');
        Route::post('/join-group', 'JoinGroupByInvitedKeyController@main');

        Route::group([
            'middleware' => 'checkGroupCreator'
        ], function () {
            Route::post('/delete-member', 'DeleteMemberInGroupController@main');
        });
    });
});

Route::group([
    'namespace' => 'Globals',
], function () {
    Route::get('/top-users', 'GetTopUsersController@main');
});
