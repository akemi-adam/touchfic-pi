<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Storie\{
    CommentchapterController, ChapterController, SearchController, StorieController
};


Route::resource('/storie', StorieController::class);

Route::get('/search', SearchController::class)->name('search');

Route::get('/likes-of-storie/{id}', [StorieController::class, 'likesOfStorie'])->name('likes.of.storie');

Route::middleware(['auth'])->group(function ()
{
    Route::get('/storie/{id}/mystories', [StorieController::class, 'myStories'])->name('storie.mystories');

    Route::get('/likes-stories/{id}', [StorieController::class, 'likes'])->name('storie.likes');
});

Route::name('chapter.')->group(function ()
{
    Route::get('/storie/{id}/create', [ChapterController::class, 'create'])->name('create');

    Route::post('/storie/{id}/chapter', [ChapterController::class, 'store'])->name('store');

    Route::get('/storie/chapter/{id}', [ChapterController::class, 'show'])->name('show');

    Route::get('/storie/edit/{id}', [ChapterController::class, 'edit'])->name('edit');

    Route::put('/storie/chapter/{id}', [ChapterController::class, 'update'])->name('update');

    Route::delete('/storie/chapter/{id}', [ChapterController::class, 'destroy'])->name('destroy');

    Route::prefix('storie/chapter/comment')->name('comment.')->group(function ()
    {
        Route::get('/{id}/edit', [CommentchapterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CommentchapterController::class, 'update'])->name('update');
    });

});