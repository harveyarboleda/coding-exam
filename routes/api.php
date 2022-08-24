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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('/', function () {
        return ['Welcome to Coding Exam / API'];
    });
    
    Route::get('/roles', [App\Http\Controllers\ApiController::class, 'roles']);
    Route::get('/users', [App\Http\Controllers\ApiController::class, 'users']);

    Route::get('/updateRole/{id}', [App\Http\Controllers\ApiController::class, 'updateRole']);
    Route::get('/updateAccount/{id}', [App\Http\Controllers\ApiController::class, 'updateAccount']);

    Route::get('/deleteRole/{id}', [App\Http\Controllers\ApiController::class, 'deleteRole']);
    Route::get('/deleteAccount/{id}', [App\Http\Controllers\ApiController::class, 'deleteAccount']);

    Route::get('/addRole', [App\Http\Controllers\ApiController::class, 'addRole']);

});
