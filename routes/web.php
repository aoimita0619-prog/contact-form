<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\AdminController;

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

 Route::get('/', [ContactController::class, 'index']);
 Route::post('/confirm', [ContactController::class, 'confirm']);
 Route::post('/thanks', [ContactController::class, 'store']);
 Route::middleware('auth')->group(function () {
      Route::get('/admin', [AdminController::class, 'admin']);
});
Route::get('/search', [AdminController::class, 'search']);
Route::get('/reset', [AdminController::class, 'reset']);
Route::delete('/delete', [AdminController::class, 'destroy']);
Route::get('/export', [AdminController::class, 'export'])->name('export');