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
    Route::get('/storie/{user}/mystories', [StorieController::class, 'myStories'])->name('storie.mystories');

    Route::get('/likes-stories/{id}', [StorieController::class, 'likes'])->name('storie.likes');
});

Route::prefix('storie')->group(function ()
{
    Route::resource('/chapter', ChapterController::class)->except([ 'create', 'store' ]);

    Route::get('/chapter/create/{id}', [ChapterController::class, 'create'])->name('chapter.create');

    Route::post('/chapter/{id}', [ChapterController::class, 'store'])->name('chapter.store');

    Route::prefix('chapter/comment')->name('chapter.comment.')->group(function ()
    {
        Route::get('/{id}/edit', [CommentchapterController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CommentchapterController::class, 'update'])->name('update');
    });

});