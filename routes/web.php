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

Route::get('/', [App\Http\Controllers\IndexController::class, 'index']);
Route::post('/', [App\Http\Controllers\IndexController::class, 'create'])->name('create');
Route::get('/search', [App\Http\Controllers\IndexController::class, 'search'])->name('search');

Route::get('/es', [App\Http\Controllers\IndexController::class, 'es']);

Route::get('/test', [App\Http\Controllers\IndexController::class, 'createIndex']);

