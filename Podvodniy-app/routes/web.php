<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\WaterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
})->name('home'); // Назначаем имя маршруту

Route::get('/blog', function () {
    return view('blog');
});

Route::get('/about', function () {
    return view('about');
});

use App\Http\Controllers\Auth\AuthController;
Route::get('/admin', [AuthController::class, 'index'])->name('admin.index');
Route::post('/admin/update', [AuthController::class, 'update'])->name('admin.update');
Route::post('/admin/delete', [AuthController::class, 'destroy'])->name('admin.delete');





Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::post('/login', [AuthController::class, 'login'])->name('login');


Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

use App\Models\Water;


Route::get('/waters/create', [WaterController::class, 'create'])->name('waters.create');
Route::post('/waters', [WaterController::class, 'store'])->name('waters.store');
Route::get('/', [WaterController::class, 'index'])->name('home');

Route::get('/waters/{id}/edit', [WaterController::class, 'edit'])->name('waters.edit');
Route::put('/waters/{id}', [WaterController::class, 'update'])->name('waters.update');
Route::delete('/waters/{id}', [WaterController::class, 'destroy'])->name('waters.destroy');

Route::post('/water/{id}', [WaterController::class, 'showCard'])->name('card.show');
Route::get('/', [WaterController::class, 'index'])->name('home');

Route::get('/water/{id}', [WaterController::class, 'showCard'])->name('card.show');


Route::post('/water/{id}/rate', [WaterController::class, 'rateWater'])->name('water.rate');







require __DIR__.'/auth.php';
