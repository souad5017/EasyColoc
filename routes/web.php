<?php

use App\Http\Controllers\ColocationController;
use App\Http\Controllers\ProfileController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['role:admin'])->group(function () {
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.createcolocation');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
});

require __DIR__.'/auth.php';
