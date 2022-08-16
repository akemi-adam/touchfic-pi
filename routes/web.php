<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenderController;

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
|     - gender resource
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
});

Route::middleware(['auth', 'admin'])->group(function ()
{
    Route::prefix('admin')->name('admin.')->group(function ()
    {
        Route::view('/', 'admin.dashboard')->name('dashboard');
        Route::resource('/gender', GenderController::class);
    });
});


require __DIR__.'/auth.php';

/* 
Route::prefix('post')->name('post.')->group(function ()
{
    Route::get('/', [PostController::class, 'index'])->name('view');
}); */