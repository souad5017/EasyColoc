<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColocationController;
use App\Http\Controllers\InvitationController;
use App\Http\Controllers\ProfileController;
use App\Models\Categories;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', [ColocationController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.createcolocation');
Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');

Route::middleware(['auth'])->group(function () {

    // colocation

    Route::get('/colocation', [ColocationController::class, 'dashboard'])->name('colocation.index');
    Route::get('/colocations/create', [ColocationController::class, 'create'])->name('colocations.createcolocation');
    Route::post('/colocations', [ColocationController::class, 'store'])->name('colocations.store');
    Route::get('/colocations/{id}', [ColocationController::class, 'show'])->name('colocations.show');

 
// Route::middleware(['auth'])->group(function () {
//     Route::get('/colocations/{colocation}/members', [ColocationController::class, 'members'])->name('colocations.members');
//     Route::get('/colocations/{colocation}/expenses', [ColocationController::class, 'expenses'])->name('colocations.expenses');
//     Route::get('/colocations/{colocation}/invitations', [ColocationController::class, 'invitations'])->name('colocations.invitations');
// });

    //invitation
    Route::get('/mambers/{colocation}/create', [InvitationController::class, 'create'])->name('members.create');
    Route::post('/mambers/{colocationId}/store', [InvitationController::class, 'sendInvitation'])->name('members.store');
    Route::get('/invitations/join/{token}', [InvitationController::class, 'join'])->name('invitations.join');
    Route::post('/invitations/{token}/accept', [InvitationController::class, 'accept'])->name('invitations.accept');


    //category
Route::get('/colocation/{id}/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/colocation/{id}/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::post('/colocationcategories/{id}/update', [CategoryController::class, 'update'])->name('categories.update');
Route::get('/colocation/categories/{id}/edit', [CategoryController::class, 'edit'])->name('categories.edit');
Route::delete('/categories/{category}', [CategoryController::class, 'destroy'])->name('categories.destroy');

});

require __DIR__ . '/auth.php';
