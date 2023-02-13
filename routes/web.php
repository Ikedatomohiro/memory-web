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

// イベント情報
Route::resource('events', 'App\Http\Controllers\EventController', ['only' => ['show', 'create', 'edit', 'store', 'update','destroy']]);
// Route::get('/{user_hash}/events', [App\Http\Controllers\EventController::class, 'index'])->name('home');
Route::get('/events', [App\Http\Controllers\EventController::class, 'index'])->name('home');

// 来客情報
Route::resource('guest', 'App\Http\Controllers\GuestController', ['only' => ['index', 'show', 'edit', 'store', 'update', 'destroy']]);
Route::get('/guest/create/{event_hash}', [App\Http\Controllers\GuestController::class, 'create'])->name('guest.create');
// 来客情報CSVダウンロード
Route::get('/guest/download/{event_hash}', [App\Http\Controllers\GuestController::class, 'download'])->name('guest.download');

// 権限コントローラ
Auth::routes();

// 郵便番号から住所取得
Route::post('/zipcode', [App\Http\Controllers\ZipCodeController::class, 'getZipCode']);
