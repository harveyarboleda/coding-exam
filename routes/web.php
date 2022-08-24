<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

Route::get('/login', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::get('/register', [App\Http\Controllers\RegisterController::class, 'index'])->name('register');

Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user');
Route::get('/logout', [App\Http\Controllers\UserController::class, 'logout'])->name('logout');

Route::post('/login', [App\Http\Controllers\LoginController::class, 'store']);
Route::post('/register', [App\Http\Controllers\RegisterController::class, 'store']);