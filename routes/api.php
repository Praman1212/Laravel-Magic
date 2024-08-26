<?php

use App\Http\Controllers\Api\TodoController;
use Illuminate\Support\Facades\Route;



// API Route
Route::get('/todo',[TodoController::class,'index']);
Route::post('/todo', [TodoController::class, 'store']);
Route::post('/todo/{id}',[TodoController::class,'update']);
Route::get('/todo/{id}',[TodoController::class,'show']);
Route::delete('/todo/{id}',[TodoController::class,'destroy']);








