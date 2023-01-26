<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactsController;
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

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::group(['prefix' => 'auth'], function ($router) {
        Route::post('register', [AuthController::class, 'register']);
        Route::post('login', [AuthController::class, 'login']);
        Route::group(['middleware' => 'auth:api'], function ($router) {
            Route::post('logout', [AuthController::class, 'logout']);
            Route::get('refresh', [AuthController::class, 'refresh']);
            Route::get('me', [AuthController::class, 'me']);
        });
    });

    Route::group(['middleware' => 'auth:api'], function ($router) {
        Route::group(['prefix' => 'contacts'], function ($router) {
            Route::get('list', [ContactsController::class, 'list']);
            Route::post('', [ContactsController::class, 'create']);
            Route::put('{id}', [ContactsController::class, 'update']);
            Route::delete('{id}', [ContactsController::class, 'delete']);
        });
    });
});
