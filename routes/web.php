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
use App\Http\Controllers\ReservationProductController;
use App\Http\Controllers\ProfileController;



Route::get('/',[FrontendController::class, 'index']);
Route::get('/gallery',[FrontendController::class, 'gallery'])->name('gallery.index');
Route::get('/about',[FrontendController::class, 'about'])->name('about.index');
Route::get('/news',[FrontendController::class, 'news'])->name('news.index');
Route::get('/contact',[FrontendController::class, 'contact'])->name('contact.index');
Route::get('/newsRead/{id}', [FrontendController::class, 'newsRead'])->name('newsRead.show');
Route::get('/profile/{id}/edit', [ProfileController::class, 'edit'])->name('profile.edit');
Route::put('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
Route::delete('/profile/{id}', [ProfileController::class, 'destroy'])->name('profile.destroy');
Route::get('/profile/{id}/edit-password', [ProfileController::class, 'profileEditPassword'])->name('profileEditPassword');
Route::put('/profile/{id}/update-password', [ProfileController::class, 'updatePassword'])->name('profileupdatePassword');

Route::get('/reservation', [ReservationCSController::class, 'index'])->name('reservation.index');
Route::post('/reservation', [ReservationCSController::class, 'store'])->name('reservation.store');
Route::get('/reservationSettings', [ReservationCSController::class, 'reservationSettingsIndex'])->name('reservation.settings.index');
Route::get('/reservationSettings/{id}', [ReservationCSController::class, 'edit'])->name('reservation.edit');
Route::put('/reservationSettings/{id}', [ReservationCSController::class, 'update'])->name('reservation.update');
Route::put('/reservationSettings/{id}/cancel', [ReservationCSController::class, 'cancel'])->name('reservation.cancel');

Route::post('/reservations/{reservation}/products', [ReservationProductController::class, 'store'])->name('reservation.products.store');
Route::put('/reservations/{reservation}/products/{product}', [ReservationProductController::class, 'update'])->name('reservation.products.update');
Route::delete('/reservations/{reservation}/products/{product}', [ReservationProductController::class, 'destroy'])->name('reservation.products.destroy');

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
   
    Route::post('/contact/{contact}/reply', [ContactController::class, 'reply'])->name('contact.reply');

    Route::get('/staff/{id}/edit-password', [StaffsController::class, 'staffEditPassword'])->name('staff.editPassword');
    Route::put('/staff/{id}/update-password', [StaffsController::class, 'updatePassword'])->name('staff.updatePassword');

});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');