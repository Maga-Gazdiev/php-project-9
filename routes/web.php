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
Route::view('/', 'main')->name('main');
Route::resource('urls', PrServer::class)->only('show', 'index', 'store');
Route::resource('urls.checks', PrServer::class)->only('store');







