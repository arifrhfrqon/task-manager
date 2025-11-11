<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\VideoController;

Route::get('/', fn() => redirect()->route('login'));

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.process');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.process');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // 🟢 ADMIN
    Route::middleware('role:admin')->group(function () {
        Route::resource('tasks', TaskController::class)->except(['show']);
        Route::resource('users', UserController::class);
        Route::post('/videos/{video}/reset-access', [VideoController::class, 'resetAccess'])->name('videos.reset.access');
    });

    // 🟡 MANAGER
    Route::middleware('role:manager')->prefix('manager')->name('manager.')->group(function () {
        Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
        Route::get('/tasks/{task}', [TaskController::class, 'show'])->name('tasks.show');
        Route::post('/tasks/{task}/status', [TaskController::class, 'updateStatus'])->name('tasks.updateStatus');
    });

    // 🔵 STAFF
    Route::middleware('role:staff')->prefix('staff')->name('staff.')->group(function () {
        Route::get('/tasks', [TaskController::class, 'staffTasks'])->name('tasks.index');
    });
    Route::get('/staff/videos', [VideoController::class, 'staffVideos'])->name('staff.videos');
    Route::resource('videos', VideoController::class)->middleware('auth');

});
