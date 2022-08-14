<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GenderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
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