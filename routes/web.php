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

Route::get('/', [App\Http\Controllers\EventListController::class, 'index'])->name('home');
Route::resource('events', 'App\Http\Controllers\EventListController', ['only' => ['index', 'show', 'create', 'edit', 'store', 'destroy']]);
Route::resource('event', 'App\Http\Controllers\EventController', ['only' => ['index', 'create', 'edit', 'store', 'destroy']]);
Route::resource('guest', 'App\Http\Controllers\GuestController', ['only' => ['index', 'show', 'create', 'edit', 'store', 'destroy']]);
