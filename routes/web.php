<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\GenreController;
use App\Http\Controllers\Admin\UserController;


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

require __DIR__ . '/auth.php';

require __DIR__ . '/storie.php';

require __DIR__ . '/post.php';