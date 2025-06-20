<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SuperAdminController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Superadmin\DashboardController as SuperadminDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use Illuminate\Support\Facades\Auth;

Route::middleware(['auth', 'verified'])->group(function () {
    // Redirect berdasarkan role
    Route::get('/dashboard', function () {
        $user = Auth::user();
        
        return match($user->role) {
            'superadmin' => redirect()->route('superadmin.dashboard'),
            'admin' => redirect()->route('admin.dashboard'),
            default => redirect()->route('user.dashboard'),
        };
    })->name('dashboard');

    // Superadmin routes
    Route::prefix('superadmin')->name('superadmin.')->middleware('superadmin')->group(function () {
        Route::get('/dashboard', [SuperadminDashboardController::class, 'index'])->name('dashboard');
    });

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    });

    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    });
});

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
     Route::get('/dashboard', function () {
        $user = Auth::user();
        
        return match($user->role_id) {
            1 => redirect()->route('superadmin.dashboard'),
            2 => redirect()->route('admin.dashboard'),
            default => redirect()->route('user.dashboard'),
        };
    })->name('dashboard');

    // Superadmin routes
    Route::prefix('superadmin')->name('superadmin.')->middleware('superadmin')->group(function () {
        Route::get('/dashboard', [SuperadminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/todo', [SuperadminDashboardController::class, 'todo'])->name('todo');
        Route::get('/add', [SuperadminDashboardController::class, 'add']);
        Route::post('/add', [SuperadminDashboardController::class, 'store']);
        Route::get('/show/{id}', [SuperadminDashboardController::class, 'show'])->name('show');
        Route::get('todo/{id}', [SuperadminDashboardController::class, 'edit']);
        Route::put('todo/{id}', [SuperadminDashboardController::class, 'update']);
        Route::delete('todo/{id}', [SuperadminDashboardController::class, 'destroy']);

    })->middleware('superadmin');

    // Admin routes
    Route::prefix('admin')->name('admin.')->middleware('admin')->group(function () {
         Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/todo', [AdminDashboardController::class, 'todo'])->name('todo');
        Route::get('/add', [AdminDashboardController::class, 'add']);
        Route::post('/add', [AdminDashboardController::class, 'store']);
        Route::get('/show/{id}', [AdminDashboardController::class, 'show'])->name('show');
        Route::get('todo/{id}', [AdminDashboardController::class, 'edit']);
        Route::put('todo/{id}', [AdminDashboardController::class, 'update']);
        Route::delete('todo/{id}', [AdminDashboardController::class, 'destroy']);
    })->middleware('admin');;

    // User routes
    Route::prefix('user')->name('user.')->group(function () {
        Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
        Route::get('/show/{id}', [UserDashboardController::class, 'show'])->name('show');
    })->middleware('user');;
});


Route::get('todo', [TodoController::class, 'index'])->name('todo');
Route::post('todo', [TodoController::class, 'store']);
Route::get('todo/{id}', [TodoController::class, 'edit']);
Route::put('todo/{id}', [TodoController::class, 'update']);
Route::delete('todo/{id}', [TodoController::class, 'destroy']);

