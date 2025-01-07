<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\PlanController;
use App\Http\Controllers\ServerController;
use App\Http\Controllers\SubServerController;
use App\Livewire\SubServerAdd;
use App\Livewire\SubServerEdit;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'verifyRole:admin']], function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin-home');

    Route::get('/notifications', [NotificationController::class, 'index'])->name('all-notifications');

    Route::post('/notification/create', [NotificationController::class, 'store'])->name('add-notification');

    Route::delete('/notification/{notification}', [NotificationController::class, 'destroy'])->name('delete-notification');

    Route::get('/plans', [PlanController::class, 'Plans'])->name('all-plans');
    Route::get('/add-plan', [PlanController::class, 'AddPlan'])->name('add-plan');
    Route::get('/plans/{plan:slug}', [PlanController::class, 'EditPlan'])->name('edit-plan');
    Route::delete('/plans/{plan:slug}', [PlanController::class, 'deletePlan'])->name('delete-plan');

    Route::get('/customers', [AdminController::class, 'AllUsers'])->name('all-users');
    Route::delete('/delete-user/{user}', [AdminController::class, 'deleteUser'])->name('delete-user');

    Route::get('/options', [OptionController::class, 'Options'])->name('all-options');
    Route::post('/options/save', [OptionController::class, 'saveOptions'])->name('save-options');

    Route::get('/adminUsers', [AdminController::class, 'allAdmins'])->name('all-admins');

    Route::get('/signup', [AdminController::class, 'addAdmin'])->name('add-admin');

    Route::get('/edit-admin/{user}', [AdminController::class, 'editAdmin'])->name('edit-admin');

    Route::delete('/delete-admin/{user}', [AdminController::class, 'deleteAdmin'])->name('delete-admin');
});
