<?php

use App\Http\Controllers\Frontend\AjaxController;
use App\Http\Controllers\Frontend\EmailController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::resource('ajax',AjaxController::class);
Route::resource('email',EmailController::class);    

require __DIR__.'/auth.php';
