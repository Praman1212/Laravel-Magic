<?php

use App\Http\Controllers\Frontend\AjaxController as AjaxController;
use App\Http\Controllers\Frontend\EmailController;
use Illuminate\Support\Facades\Route;

Route::resource('ajax', AjaxController::class);
Route::resource('email',EmailController::class);
