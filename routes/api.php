<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PurchaseController;
use App\Http\Controllers\Api\ServerController;
use App\Http\Controllers\Api\SocialController;
use App\Http\Controllers\Api\VerifyController;
use App\Http\Controllers\ChatController;
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
});

Route::post('/email/resend-verification', [VerifyController::class, 'resendVerify'])->name('api.verify.resend');

Route::get('/servers', [ServerController::class, 'index'])->name('api.all.servers');

Route::get('/options', [OptionController::class, 'getOptions'])->name('api.options');
