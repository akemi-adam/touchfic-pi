<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\GenderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|
| - Root routes
| - Auth routes
| - Posts routes
| - Admin routes
| - Stories routes
|
|--------------------------------------------------------------------------
*/

Route::name('root.')->group(function ()
{
    Route::view('/', 'welcome')->name('home');
    Route::view('/about', 'about')->name('about');
    Route::view('/faq', 'faq')->name('faq');
});

Route::prefix('auth')->name('auth.')->group(function ()
{

    Route::view('/login', 'auth.login')->name('login.view');

    Route::post('/login', function ()
    {
        return "Página de login post";
    })->name('login.post');

    Route::view('/register', 'auth.register')->name('register.view');

    Route::post('/register', function ()
    {
        return "Página de register post";
    })->name('register.post');

    Route::view('/dashboard', 'auth.dashboard')->name('dashboard');
});

Route::prefix('admin')->name('admin.')->group(function ()
{
    Route::view('/', 'admin.dashboard')->name('dashboard');
    Route::resource('/gender', GenderController::class);
});

Route::prefix('post')->name('post.')->group(function ()
{
    Route::get('/', [PostController::class, 'index'])->name('view');
});

