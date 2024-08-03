<?php

use App\Http\Controllers\Frontend\AjaxController as AjaxController;
use Illuminate\Support\Facades\Route;

Route::resource('ajax', AjaxController::class);
