<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post\CommentpostController;
use App\Http\Controllers\Post\PostController;
use App\Http\Controllers\Post\ModeratorController;

Route::resource('/post', PostController::class);

Route::delete('/post/{id}/moderator', [ModeratorController::class, 'deletePost'])->name('moderator.post.destroy');

Route::prefix('post/comment')->name('post.comment.')->group(function ()
{
    Route::get('/{comment}/edit', [CommentpostController::class, 'edit'])->name('edit');
    Route::put('/{comment}', [CommentpostController::class, 'update'])->name('update');
});