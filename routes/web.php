<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ContactController;

use App\Http\Controllers\FrontendController;


Route::get('/',[FrontendController::class, 'index']);
Route::get('/gallery',[FrontendController::class, 'gallery'])->name('gallery.index');
Route::get('/about',[FrontendController::class, 'about'])->name('about.index');
Route::get('/news',[FrontendController::class, 'news'])->name('news.index');
Route::get('/contact',[FrontendController::class, 'contact'])->name('contact.index');

// Proses form kontak (POST)
Route::post('/contact', [FrontendController::class, 'storeContact'])->name('contact.store');


// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

// Force logout
Route::get('/logout', function () {
    Auth::logout();
    return redirect('/');
});

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', Admin::class]], function ()
{
   Route::get('/', [BackendController::class,'index']); 

    // Crud
    Route::resource('/product', ProductController::class);
    Route::resource('/contact', ContactController::class);
    Route::resource('/about', AboutController::class);
    Route::resource('/news', NewsController::class);   
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');