<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('Admin')->group(function () {
    // Routes inside this group will use the 'Admin' namespace for controller resolution

    Route::get('dashboard', 'DashboardController@index');
    Route::get('users', 'UserController@index');
});
//Import user control
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', UserController::class.'@index');

Route::post('users', [UserController::class, 'store']);
Route::get('users/{id}', [UserController::class, 'show']);
Route::post('users/{id}', [UserController::class, 'update']);
// Route::put('/users/{id}', 'UserController@update'); PUT just send only idS
Route::delete('users/{id}', [UserController::class, 'destroy']);

// Route::namespace('Admin')->group(function () {
//     // Routes inside this group will use the 'Admin' namespace for controller resolution

//     Route::get('dashboard', 'DashboardController@index');
//     Route::get('users', 'UserController@index');
// });

Route::post('login', [UserController::class, 'authenticate']);

    //Route::post('login', 'UserController@authenticate');
    Route::get('open', 'DataController@open');

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::get('user', 'UserController@getAuthenticatedUser');
        Route::get('closed', 'DataController@closed');
    });