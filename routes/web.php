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
    return redirect()->route('index');
})->name('/');

Route::view('index', 'index')->name('index');

Route::prefix('system-setting')->group(function () {

    Route::resource('users', \App\Http\Controllers\UserController::class)->except('show');
    Route::post('userss/ajax', [\App\Http\Controllers\UserController::class, 'getAjax'])->name('users.ajax');

});
