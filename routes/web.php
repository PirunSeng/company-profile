<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactController;
use App\Models\User;
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
    return view('welcome');
});

Route::get('/about-bla-bla-bla', [ContactController::class, 'index'])->name('con');


Route::get('/about', function () {
    return view('about');
})->middleware('age');

Route::get('/category/all', [CategoryController::class, 'index'])->name('categories');
Route::post('/category/add', [CategoryController::class, 'add'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'edit']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all(); // using this, in view no need to use Carbon\Carbon::parse(...)
    $users = DB::table('users')->get();
    return view('dashboard', compact('users'));
})->name('dashboard');
