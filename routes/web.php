<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MultipicController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    $brands = DB::table('brands')->get();
    $homeabout = DB::table('home_abouts')->first();
    return view('home', compact('brands', 'homeabout'));
});

Route::get('/about-bla-bla-bla', [ContactController::class, 'index'])->name('con');

Route::get('/about', function () {
    return view('about');
})->middleware('age');

Route::get('/category/all', [CategoryController::class, 'index'])->name('categories');
Route::post('/category/add', [CategoryController::class, 'add'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);
Route::get('/category/softDelete/{id}', [CategoryController::class, 'softDelete']);
Route::get('/category/restore/{id}', [CategoryController::class, 'restore']);
Route::get('/category/delete/{id}', [CategoryController::class, 'delete']);

Route::get('/brand/all', [BrandController::class, 'index'])->name('brands');
Route::post('/brand/add', [BrandController::class, 'add'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'delete']);

// Multi image route
Route::get('/multipic/all', [MultipicController::class, 'index'])->name('multipics');
Route::post('/multipic/add', [MultipicController::class, 'add'])->name('store.multipic');

// Admin all route
Route::get('/home/slider', [HomeController::class, 'slider'])->name('home.slider');
Route::get('/home/slider/create', [HomeController::class, 'createSlider'])->name('add.slider');
Route::post('/home/slider/store', [HomeController::class, 'storeSlider'])->name('store.slider');

// Home About
Route::get('/home/about', [AboutController::class, 'homeAbout'])->name('home.about');
Route::get('/about/add', [AboutController::class, 'add'])->name('add.about');
Route::post('/about/store', [AboutController::class, 'store'])->name('store.about');
Route::get('/about/edit/{id}', [AboutController::class, 'edit'])->name('edit.about');
Route::post('/about/update/{id}', [AboutController::class, 'update'])->name('update.about');
Route::get('/about/delete/{id}', [AboutController::class, 'delete'])->name('delete.about');

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('admin.index');
})->name('dashboard');

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/auth/logout', [AuthController::class, 'logout'])->name('auth.logout');
