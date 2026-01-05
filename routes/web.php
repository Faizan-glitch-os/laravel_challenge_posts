<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PostController::class, 'index'])->name('home');

Route::get('/create_post', [PostController::class, 'create'])->name('show.create');
Route::post('/create_post', [PostController::class, 'store'])->name('create.post');

Route::delete('/delete_post/{id}', [PostController::class, 'destroy'])->name('delete.post');

Route::get('/edit_post/{id}', [PostController::class, 'edit'])->name('show.edit');
Route::put('/edit_post/{id}', [PostController::class, 'update'])->name('edit.post');
