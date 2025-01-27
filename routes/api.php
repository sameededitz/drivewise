<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\VerifyController;
use App\Http\Controllers\CarController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\ReminderController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::post('/login', [AuthController::class, 'login'])->name('api.login');

    Route::post('/signup', [AuthController::class, 'signup'])->name('api.signup');

    Route::post('/auth/google', [SocialController::class, 'handleAppleCallback'])->name('api.auth.google');

    Route::post('/auth/apple', [SocialController::class, 'handleAppleCallback'])->name('api.auth.apple');

    Route::post('/reset-password', [VerifyController::class, 'sendResetLink'])->name('api.reset.password');
});

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('api.logout');

    Route::get('/chats', [ChatController::class, 'chats'])->name('api.chats');

    Route::post('/chats/create', [ChatController::class, 'createChat'])->name('api.chat.create');

    Route::post('/chats/{id}', [ChatController::class, 'saveMessage'])->name('api.chat.save');

    Route::delete('/chats/{id}', [ChatController::class, 'destroy'])->name('api.chat.delete');

    Route::get('/reminders', [ReminderController::class, 'index'])->name('api.reminders');

    Route::post('/reminders/create', [ReminderController::class, 'store'])->name('api.reminder.store');

    Route::delete('/reminders/{id}', [ReminderController::class, 'destroy'])->name('api.reminder.delete');

    Route::post('/purchase', [PurchaseController::class, 'addPurchase'])->name('api.add.purchase');

    Route::post('/purchase/status', [PurchaseController::class, 'Status'])->name('api.purchase');

    Route::get('/cars', [CarController::class, 'cars'])->name('api.cars');

    Route::post('/cars/add', [CarController::class, 'addCar'])->name('api.add.car');

    Route::get('/cars/{id}', [CarController::class, 'show'])->name('api.update.car');

    Route::put('/cars/{id}', [CarController::class, 'update'])->name('api.update.car');

    Route::delete('/cars/{id}', [CarController::class, 'delete'])->name('api.delete.car');

    Route::get('/user/license', [UserController::class, 'show'])->name('user.license.show');
    
    Route::post('/user/license', [UserController::class, 'store'])->name('user.license.store');
});

Route::post('/email/resend-verification', [VerifyController::class, 'resendVerify'])->name('api.verify.resend');

Route::get('/options', [OptionController::class, 'getOptions'])->name('api.options');

Route::get('/notifications', [NotificationController::class, 'notifications'])->name('api.notifications');