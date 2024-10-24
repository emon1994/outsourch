<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\CustomerAuthController;


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

Route::get('/', function () {
    return view('frontend.index');
});



Route::group(['middleware' => ['guest']], function () {
    // Customer Auth Routes
    Route::get('customer/register', [CustomerAuthController::class, 'showRegistrationForm'])->name('customer.register');
    Route::post('customer/register', [CustomerAuthController::class, 'register'])->name('customer-registration');
    Route::get('customer/login', [CustomerAuthController::class, 'showLoginForm'])->name('customer.login');
    Route::post('customer/login', [CustomerAuthController::class, 'login']);

    // Admin Auth Routes (using Breeze default)
    Route::get('admin/login', [AuthenticatedSessionController::class, 'create'])->name('login');
    Route::post('admin/login', [AuthenticatedSessionController::class, 'store']);
});


// Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout')->middleware('auth:customer');

// Route::middleware('auth:customer')->group(function () {
//     Route::get('customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
// });


Route::middleware('auth:customer')->group(function () {
    Route::post('customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');
    Route::get('customer/dashboard', [CustomerController::class, 'dashboard'])->name('customer.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [AuthenticatedSessionController::class, 'create'])->name('dashboard');
});























Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
