<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UrlController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UrlsCheckController;
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

Route::get('/', [HomeController::class, 'main'])
    ->name('main');

Route::resource('urls', UrlController::class);

Route::post('urls/{id}/checks', [UrlsCheckController::class, 'check'])
    ->name('urls.check');