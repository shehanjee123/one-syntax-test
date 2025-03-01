<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;





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


Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index'])->name('home');

// user subscription route
Route::post('website/subscription', [SubscriptionController::class, 'store'])->name('subscription.make');

// Post Upload
Route::get('website/post-form', [WebsiteController::class, 'index'])->name('post.upload-form');
Route::post('website/post', [WebsiteController::class, 'store'])->name('post.upload');

// show post
Route::get('/post/{id}', [WebsiteController::class, 'showPost'])->name('post.show');
Route::get('/old-post', [WebsiteController::class, 'showOldPost'])->name('oldPost');

// send mail
Route::post('/send-mail', [WebsiteController::class, 'sendMailFn'])->name('sendMail');
