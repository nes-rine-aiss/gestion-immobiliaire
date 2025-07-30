<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboardadmin');
})->middleware(['auth'])->name('dashboard');








######################################### User Management Routes #########################################

// Route::resource('users', UserController::class);



################## Actions pour tous le monde pas de middlware role ################

Route::middleware(['auth'])->group(function () {
    Route::get('/dashbord', function () {
        return view('dashbordproprietaire');
    })->name('test');
});


################## Actions super-admin + admin + proprietaire ################

Route::middleware(['auth', 'role:admin|superadmin|proprietaire'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/{user}/show', [UserController::class, 'show'])->name('users.show');
    
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    
    Route::put('/users/{user}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{user}', [UserController::class, 'edit'])->name('users.edit');
    
});


################## Actions super-admin + admin ################

Route::middleware(['auth', 'role:admin|superadmin'])->group(function () {
    Route::put('/users/{user}/update-password', [UserController::class, 'updatePassword'])->name('users.update-password');
});






################## Actions super-admin ################

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
});

















######################################### Profile Management Routes #########################################

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
