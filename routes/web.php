<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CommentchapterController;
use App\Http\Controllers\CommentpostController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ChapterController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\StorieController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


Route::name('root.')->group(function ()
{
    Route::view('/', 'welcome')->middleware('guest')->name('home');
    Route::view('/about', 'about')->name('about');
    Route::view('/faq', 'faq')->name('faq');
});

Route::middleware(['auth'])->group(function ()
{
    Route::view('/dashboard', 'auth.dashboard')->name('dashboard');

    Route::get('/search', [SearchController::class, 'search'])->name('search');

    Route::resource('/post', PostController::class);

    Route::resource('/storie', StorieController::class);
    Route::get('/storie/{user}/mystories', [StorieController::class, 'myStories'])->name('storie.mystories');
    Route::get('/likes-stories/{user}', [StorieController::class, 'likes'])->name('storie.likes');

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

    Route::prefix('comment')->name('comment.')->group(function ()
    {
        Route::post('/store/{post}/', [CommentpostController::class, 'store'])->name('store');
        Route::get('/{comment}/edit', [CommentpostController::class, 'edit'])->name('edit');
        Route::put('/{comment}', [CommentpostController::class, 'update'])->name('update');
        Route::delete('/post/{comment}', [CommentpostController::class, 'destroy'])->name('destroy');
    });

    Route::prefix('user')->name('user.')->group(function ()
    {
        Route::get('/{id}', [UserController::class, 'show'])->name('show');
        Route::get('/{id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{id}', [UserController::class, 'update'])->name('update');
    });
});

Route::middleware(['auth', 'admin'])->group(function ()
{
    Route::prefix('admin')->name('admin.')->group(function ()
    {
        Route::view('/', 'admin.dashboard')->name('dashboard');
        Route::resource('/genre', GenreController::class);
        
        Route::prefix('permission')->name('permission.')->group(function ()
        {
            Route::get('/index', [PermissionController::class, 'index'])->name('index');
            Route::get('/edit', [PermissionController::class, 'edit'])->name('edit');
            Route::put('/update', [PermissionController::class, 'update'])->name('update');
            Route::get('/change/{user}', [PermissionController::class, 'change'])->name('change');
            Route::put('/transference/{user}', [PermissionController::class, 'transference'])->name('transference');
        });
    });
});

require __DIR__.'/auth.php';