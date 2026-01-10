<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\Admin;

use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\NewsController;
use App\Http\Controllers\Backend\AboutController;
use App\Http\Controllers\Backend\ContactController;
use App\Http\Controllers\Backend\StaffsController;
use App\Http\Controllers\Backend\ReservationController;


use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ReservationCSController;
use App\Http\Controllers\ReviewController;



Route::get('/',[FrontendController::class, 'index']);
Route::get('/gallery',[FrontendController::class, 'gallery'])->name('gallery.index');
Route::get('/about',[FrontendController::class, 'about'])->name('about.index');
Route::get('/news',[FrontendController::class, 'news'])->name('news.index');
Route::get('/contact',[FrontendController::class, 'contact'])->name('contact.index');
Route::get('/newsRead/{id}', [FrontendController::class, 'newsRead'])->name('newsRead.show');

Route::get('/reservation', [ReservationCSController::class, 'index'])->name('reservation.index');
Route::post('/reservation', [ReservationCSController::class, 'store'])->name('reservation.store');
Route::get('/reservationSettings', [ReservationCSController::class, 'reservationSettingsIndex'])->name('reservation.settings.index');
Route::get('/reservationSettings/{id}', [ReservationCSController::class, 'edit'])->name('reservation.edit');
Route::put('/reservationSettings/{id}', [ReservationCSController::class, 'update'])->name('reservation.update');

//Reviews
Route::post('/products/{product}/reviews', [ReviewController::class, 'store'])->middleware('auth')->name('reviews.store');

// Proses form kontak (POST)
Route::post('/contact', [FrontendController::class, 'storeContact'])->name('contact.store');

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
    Route::resource('/staff', StaffsController::class); 
    Route::resource('/reservation', ReservationController::class);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');