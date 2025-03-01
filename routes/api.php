<?php

use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// This is the Website regiter Route
Route::post('website/register', [WebsiteController::class, 'register'])->name('website.register');

// This is the Post Uploaded Route
Route::post('create/post', [WebsiteController::class, 'store'])->name('create.post');

// This is the User Registration Route
Route::post('create/user', [UserController::class, 'store'])->name('user.details');

// This is the Subcription Route
Route::post('subscription/make', [SubscriptionController::class, 'store'])->name('subscription.make');

