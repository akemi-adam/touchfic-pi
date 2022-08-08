<?php

use Illuminate\Support\Facades\Route;

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





/* 
Route::get('/about', function ()
{
    return 'About page';
})->name('about');

Route::get('/faq/{question}', function ($question)
{
    return "O número da questão foi: $question";
})->name('faq');

Route::get('/user/{name}', function ($name)
{
    return "Your name is $name";
})->name('user.name');

Route::prefix('user')->group(function ()
{
    Route::view('/', 'welcome');
    Route::get('/{name}', function ($name)
    {
        return "The name of user is $name";
    });
});

 */