<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\CommentpostController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| - Root rotes
|   - /
|   - /about
|   - /faq
| - Auth routes
|   - /dashboard
|   - Admin routes
|     - /admin
|     - genre resource
|
*/

Route::name('root.')->group(function ()
{
    Route::view('/', 'welcome')->name('home');
    Route::view('/about', 'about')->name('about');
    Route::view('/faq', 'faq')->name('faq');
});

Route::middleware(['auth'])->group(function ()
{
    Route::view('/dashboard', 'auth.dashboard')->name('dashboard');
    Route::resource('/post', PostController::class);

    Route::prefix('comment')->name('comment.')->group(function ()
    {
        Route::post('/store/{post}/', [CommentpostController::class, 'store'])->name('store');
        Route::get('/{comment}/edit', [CommentpostController::class, 'edit'])->name('edit');
        Route::put('/{comment}', [CommentpostController::class, 'update'])->name('update');
        Route::delete('/post/{comment}', [CommentpostController::class, 'destroy'])->name('destroy');
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
        });
    });
});

require __DIR__.'/auth.php';