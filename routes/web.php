<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VetController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\MyOrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AdminVetsController;
use App\Http\Controllers\AdminOrdersController;
use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\VetDashboardController;
use App\Http\Controllers\AdminProductsController;
use App\Http\Controllers\AdminPetOwnersController;
use App\Models\Appointment;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/cart', [ShopController::class, 'cart'])->middleware('pet_owner');
Route::post('/shop/cart/{product}/add', [ShopController::class, 'store'])->middleware('auth')->middleware('pet_owner');
Route::delete('/shop/cart/{cart}', [ShopController::class, 'destroy']);

Route::get('/myprofile', [ProfileController::class, 'index'])->middleware('pet_owner');
Route::get('/myprofile/edit', [ProfileController::class, 'edit'])->middleware('pet_owner');
Route::put('/myprofile', [ProfileController::class, 'update']);

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article:slug}', [ArticleController::class, 'show']);