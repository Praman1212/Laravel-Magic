<?php

use App\Http\Controllers\Frontend\AjaxController;
use App\Http\Controllers\Frontend\EmailController;
use App\Http\Controllers\Frontend\UrlController;
use Illuminate\Support\Facades\Route;


Route::resource('ajax',AjaxController::class);
Route::resource('email',EmailController::class); 

Route::get('/', function () {
    return view('redis.index');
});
Route::post('/shorten', [UrlController::class, 'store']);
Route::get('/{shortCode}', [UrlController::class, 'redirect']);

