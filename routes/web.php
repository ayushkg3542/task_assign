<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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
    return view('auth.login');
});

Route::get('/dashboard', [ProfileController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/item/create',[ItemController::class, 'create'])->name('item.create');
    Route::post('/item/store',[ItemController::class, 'store'])->name('item.store');
    Route::get('/item/edit/{id}',[ItemController::class, 'edit'])->name('item.edit');
    Route::post('/item/modify/{id}',[ItemController::class, 'modify'])->name('item.modify');
    Route::get('/item/destroy/{id}',[ItemController::class, 'destroy'])->name('item.destroy');
});

require __DIR__.'/auth.php';
