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

Route::get('/articles', [ArticleController::class, 'index']);
Route::get('/articles/{article:slug}', [ArticleController::class, 'show']);

Route::get('/vet', [AppointmentController::class, 'index']);
Route::get('/vet/make-appointment/{vet:vet_id}', [AppointmentController::class, 'makeAppointment'])->middleware('auth')->middleware('pet_owner');
Route::get('/vet/payment', [AppointmentController::class, 'paymentAppointment'])->middleware('pet_owner');
Route::put('/vet/payment/{appointment}', [AppointmentController::class, 'update']);
Route::post('/vet/make-appointment/{vet:vet_id}', [AppointmentController::class, 'store']);
Route::get('/myappointment', [AppointmentController::class, 'myAppointment'])->middleware('pet_owner');

Route::get('/shop', [ShopController::class, 'index']);
Route::get('/shop/cart', [ShopController::class, 'cart'])->middleware('pet_owner');
Route::post('/shop/cart/{product}/add', [ShopController::class, 'store'])->middleware('auth')->middleware('pet_owner');
Route::delete('/shop/cart/{cart}', [ShopController::class, 'destroy']);

Route::get('/myprofile', [ProfileController::class, 'index'])->middleware('pet_owner');
Route::get('/myprofile/edit', [ProfileController::class, 'edit'])->middleware('pet_owner');
Route::put('/myprofile', [ProfileController::class, 'update']);

Route::get('/payment', [PaymentController::class, 'index'])->middleware('pet_owner');
Route::post('/payment', [PaymentController::class, 'productsPayment']);
Route::get('/payment/invoice', [PaymentController::class, 'invoice'])->middleware('pet_owner');

Route::get('/myorder', [MyOrderController::class, 'index'])->middleware('pet_owner');
Route::put('/myorder/{order}', [MyOrderController::class, 'update']);
Route::get('/myorder/detail', [MyOrderController::class, 'show'])->middleware('pet_owner');

Route::get('/myappointment', [AppointmentController::class, 'myAppointment'])->middleware('pet_owner');
Route::put('/myappointment/{appointment}', [AppointmentController::class, 'updateAppointment']);

Route::resource('/dashboard/products', AdminProductsController::class)->except('show')->middleware('admin');

Route::get('/dashboard/orders', [AdminOrdersController::class, 'index'])->middleware('admin');
Route::put('/dashboard/orders/{order}', [AdminOrdersController::class, 'update']);
Route::get('/dashboard/orders/detail', [AdminOrdersController::class, 'show'])->middleware('admin');

Route::get('/dashboard', [AdminController::class, 'index'])->middleware('admin');
Route::get('/dashboard/petowners ', [AdminPetOwnersController::class, 'index'])->middleware('admin');
Route::delete('/dashboard/petowners/{petOwner:pet_owner_id}', [AdminPetOwnersController::class, 'destroy']);

Route::get('/dashboard/vets', [AdminVetsController::class, 'index'])->middleware('admin');
Route::get('/dashboard/vets/create', [AdminVetsController::class, 'create'])->middleware('admin');
Route::post('/dashboard/vets', [AdminVetsController::class, 'store']);
Route::delete('/dashboard/vets/{vet:vet_id}', [AdminVetsController::class, 'destroy']);

Route::get('/vetdashboard', [VetDashboardController::class, 'index'])->middleware('vet');
Route::get('/vetdashboard/articles', [VetDashboardController::class, 'articles'])->middleware('vet');
Route::get('/vetdashboard/articles/create', [VetDashboardController::class, 'create'])->middleware('vet');
Route::get('/vetdashboard/editprofile', [VetDashboardController::class, 'edit'])->middleware('vet');
Route::put('/vetdashboard/editprofile', [VetDashboardController::class, 'update']);
Route::post('/vetdashboard/articles', [VetDashboardController::class, 'store']);
Route::delete('/vetdashboard/articles/{article:slug}', [VetDashboardController::class, 'destroy']);
