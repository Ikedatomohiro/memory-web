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

Route::get('/', [App\Http\Controllers\EventController::class, 'index'])->name('home');

// イベント情報
Route::resource('events', 'App\Http\Controllers\EventController', ['only' => ['index', 'show', 'create', 'edit', 'store', 'destroy']]);

// 来客情報
Route::resource('guest', 'App\Http\Controllers\GuestController', ['only' => ['index', 'show', 'edit', 'store', 'destroy']]);
Route::get('/guest/{event_hash}/create', [App\Http\Controllers\GuestController::class, 'create'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
