<?php

use App\Http\Controllers\AffiliateController;
use App\Http\Controllers\CommissionController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function() {
    return view('auth.login');
})->middleware('role.redirect')->name('login');


Route::controller(LandingController::class)->group(function() {
    route::get('/landing', 'trackAffiliateClick')->name('landing.index');
    route::post('/landing/submitProject', 'submitProject')->name('landing.submitProject');
    route::get('/landing/success', 'success')->name('landing.success');
});

Route::controller(AffiliateController::class)->group(function() {
    route::get('/register', 'register')->name('affiliate.register');
    route::get('/registration', 'registrationAffiliate')->name('affiliate.registration')->middleware(['auth', 'role:Admin']);
    route::patch('/registration/{id}/active', 'activeAffiliate')->name('affiliate.active')->middleware(['auth', 'role:Admin']);
    route::patch('/registration/{id}/reject', 'rejectAffiliate')->name('affiliate.reject')->middleware(['auth', 'role:Admin']);
    route::get('/affiliate', 'affiliate')->name('affiliate.affiliate')->middleware(['auth', 'role:Admin']);
    route::get('/affiliate/detail/{affiliate}', 'detail')->name('affiliate.detail')->middleware(['auth', 'role:Admin']);
    route::get('/link', 'link')->name('affiliate.link')->middleware(['auth', 'role:Affiliate']);
    Route::put('/affiliate/{id}/deactivate', 'deactivate')->name('affiliate.deactivate')->middleware(['auth']);
    Route::put('/affiliate/{id}/activate', 'activate')->name('affiliate.activate')->middleware(['auth']);
});

Route::controller(ProjectController::class)->group(function() {
    route::get('/project', 'index')->name('project.index');
    route::get('/project/detail/{project}', 'detail')->name('project.detail');
    route::put('/project/update/{project}', 'update')->name('project.update');
    route::delete('/project/destroy/{project}', 'destroy')->name('project.destroy');
});

Route::controller(WithdrawalController::class)->group(function() {
    route::get('/withdrawal', 'index')->name('withdrawal.index')->middleware(['auth']);
    route::post('/withdrawal/request', 'request')->name('withdrawal.request')->middleware(['auth']);
    route::post('/withdrawal/{withdrawal}/process', 'processWithdrawal')->name('withdrawal.process')->middleware(['auth']);
});


Route::controller(CommissionController::class)->group(function() {
    route::get('/commission', 'index')->name('commission.index');
});

Route::controller(DashboardController::class)->group(function() {
    route::get('/dashboard', 'index')->name('dashboard')->middleware(['auth', 'role:Affiliate']);
    route::get('/dashboardAdmin', 'admin')->name('dashboardAdmin')->middleware(['auth', 'role:Admin']);
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::get('/terms', function () {
    return view('terms');
})->name('terms');

Route::get('/privacy', function () {
    return view('privacy');
})->name('privacy');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
