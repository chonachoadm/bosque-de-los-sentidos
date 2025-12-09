<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartItemController;
use App\Http\Controllers\PurchaseController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::resource('/products', ProductController::class)->middleware('protected');

Route::resource('/tags', TagController::class)->middleware('protected');

Route::resource('/users', UserController::class)->middleware('protected');
Route::get('/users/{user}/purchase-history', [UserController::class, 'purchaseHistory'])->name('users.purchase-history')->middleware('protected');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('protected');

Route::get('/games', [GameController::class, 'index'])->name('games');
Route::get('/games/{product}', [GameController::class, 'show'])->name('details');

Route::get('/about', AboutController::class)->name('about');
Route::get('/contact', ContactController::class)->name('contact');

Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('public-area.profile.edit');
Route::put('/profile/update', [ProfileController::class, 'update'])->name('public-area.profile.update');
Route::get('/profile/purchase/{purchase}', [ProfileController::class, 'showPurchase'])->name('purchase.data');
Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');

Route::resource('/cart', CartItemController::class);
Route::delete('/cart', [CartItemController::class, 'clear'])->name('cart.clear');

Route::get('purchases/callback', [PurchaseController::class, 'storePurchase'])->name('purchase.callback');
Route::get('/purchases/{id}/store/{statusName}', [PurchaseController::class, 'storePurchaseProducts'])->name('purchase.response');
Route::resource('/purchases', PurchaseController::class)->middleware('protected');
