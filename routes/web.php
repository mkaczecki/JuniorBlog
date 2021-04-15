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
    return redirect()->to(\App\Providers\RouteServiceProvider::HOME);
});

Auth::routes();

Route::get('/posts', [App\Http\Controllers\PostController::class, 'index']);
Route::get('/posts/{post}', [App\Http\Controllers\PostController::class, 'show']);
Route::get('/posts/create', [App\Http\Controllers\PostController::class, 'create']);
Route::get('/posts/edit/{post}', [App\Http\Controllers\PostController::class, 'show']);

Route::get('/admin', [App\Http\Controllers\AdminController::class, 'dashboard']);

