<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\CommentpostController;
use App\Http\Controllers\Post\PostController;

Route::resource('/post', PostController::class);

Route::prefix('comment')->name('comment.')->group(function ()
{
    Route::post('/store/{post}/', [CommentpostController::class, 'store'])->name('store');
    Route::get('/{comment}/edit', [CommentpostController::class, 'edit'])->name('edit');
    Route::put('/{comment}', [CommentpostController::class, 'update'])->name('update');
    Route::delete('/post/{comment}', [CommentpostController::class, 'destroy'])->name('destroy');
});