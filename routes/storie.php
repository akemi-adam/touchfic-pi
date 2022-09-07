<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storie\{
    CommentchapterController, ChapterController, SearchController, StorieController
};


Route::resource('/storie', StorieController::class);

Route::get('/search', [SearchController::class, 'search'])->name('search');

Route::get('/likes-of-storie/{id}', [StorieController::class, 'likesOfStorie'])->name('likes.of.storie');

Route::middleware(['auth'])->group(function ()
{
    Route::get('/storie/{user}/mystories', [StorieController::class, 'myStories'])->name('storie.mystories');

    Route::get('/likes-stories/{user}', [StorieController::class, 'likes'])->name('storie.likes');
});

Route::name('chapter.')->group(function ()
{
    Route::get('/storie/{storie}/create', [ChapterController::class, 'create'])->name('create');

    Route::post('/storie/{storie}/chapter', [ChapterController::class, 'store'])->name('store');

    Route::get('/storie/chapter/{chapter}', [ChapterController::class, 'show'])->name('show');

    Route::get('/storie/edit/{chapter}', [ChapterController::class, 'edit'])->name('edit');

    Route::put('/storie/chapter/{chapter}', [ChapterController::class, 'update'])->name('update');

    Route::delete('/storie/chapter/{chapter}', [ChapterController::class, 'destroy'])->name('destroy');

    Route::prefix('storie/chapter/comment')->name('comment.')->group(function ()
    {
        Route::post('/store/{chapter}/', [CommentchapterController::class, 'store'])->name('store');

        Route::get('/{comment}/edit', [CommentchapterController::class, 'edit'])->name('edit');

        Route::put('/{comment}', [CommentchapterController::class, 'update'])->name('update');

        Route::delete('/post/{comment}', [CommentchapterController::class, 'destroy'])->name('destroy');
    });

});