<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index']);
Route::view('/create_post', 'create_post');
Route::post('/create_post', [PostController::class, 'create']);
Route::delete('/delete_post/{id}', [PostController::class, 'destroy']);
