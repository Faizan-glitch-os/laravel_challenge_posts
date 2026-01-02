<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/published_posts',[ PostController::class, 'index']);
Route::view('/create_post','create_post');
Route::post('/create_post', [PostController::class, 'create']);