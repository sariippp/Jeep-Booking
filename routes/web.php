<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/gallery', function () {
    return view('gallery');
})->name('gallery');

Route::get('/faq', function () {
    return view('faq');
})->name('faq');

Route::get('/contact', function () {
    return view('contact');
})->name('contact');

//KIRIM EMAIL
Route::post('/contact/send', 'App\Http\Controllers\UserController@sendContactEmail')->name('contact.send');

//HALAMAN BOOKING
Route::get('/booking', [UserController::class, 'index'])->name('booking.form');
Route::get('/get-sessions', [UserController::class, 'getSessions'])->name('get.sessions');
Route::post('/check-session', [UserController::class, 'checkSession'])->name('check.session');
Route::post('/store-reservation', [UserController::class, 'store'])->name('store.reservation');
Route::get('/booking/confirmation/{id}', [UserController::class, 'confirmation'])->name('booking.confirmation');
Route::post('/pay-qris', [UserController::class, 'payWithQRIS'])->name('pay.qris');

// Payment routes
Route::get('/pay-qris', [UserController::class, 'payWithQRIS']);
Route::post('/check-payment-status', [UserController::class, 'checkPaymentStatus']);


