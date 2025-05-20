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

// Authentication Routes
Route::get('/login', [\App\Http\Controllers\AuthenticationController::class, 'showLoginForm'])->name('login')->middleware('guest');
Route::post('/login', [\App\Http\Controllers\AuthenticationController::class, 'login'])->name('login.submit');
Route::post('/logout', [\App\Http\Controllers\AuthenticationController::class, 'logout'])->name('logout')->middleware('auth');

// Protect index route
Route::get('/', function () {
    return redirect()->route('index');
})->name('/');

Route::view('index', 'index')->name('index')->middleware('auth');

Route::prefix('system-setting')->group(function () {

    Route::resource('users', \App\Http\Controllers\UserController::class)->except('show');
    Route::post('users/ajax', [\App\Http\Controllers\UserController::class, 'getAjax'])->name('users.ajax');

});
