<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('auth.login');
})->middleware('guest')->name('login');

Route::controller(AffiliateController::class)->group(function() {
    route::get('/register', 'register')->name('affiliate.register');
    route::get('/affiliate/registration', 'registrationAffiliate')->name('affiliate.registration')->middleware(['auth', 'role:Admin']);
    route::patch('/affiliate/{id}/active', 'activeAffiliate')->name('affiliate.active')->middleware(['auth', 'role:Admin']);
    route::patch('/affiliate/{id}/reject', 'rejectAffiliate')->name('affiliate.reject')->middleware(['auth', 'role:Admin']);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
