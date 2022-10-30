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
Route::get('/', 'App\Http\Controllers\PrServer@home')->name('/home');

Route::get('/url', 'App\Http\Controllers\PrServer@welcome')->name('/welcome');

Route::get('/urls', 'App\Http\Controllers\PrServer@index')->name('urls.index');

Route::post('/urls', 'App\Http\Controllers\PrServer@store')->name('urls.store');

Route::post('/urls/{id}/checks', 'App\Http\Controllers\PrServer@checks')->name('urls.checks');

Route::get('/urls/{id}', 'App\Http\Controllers\PrServer@show')->name('urls.show');







