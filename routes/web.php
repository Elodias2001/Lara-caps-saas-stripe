<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Suscribe\CreateController;
use App\Http\Controllers\Suscribe\StoreController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){

    Route::get('/dashboard', function () {return view('dashboard');})->name('dashboard');
    Route::prefix('subscribe') // Pour le prefix url de mes routes
    ->as('subscribe.') // Pour le nom de mes routes qui seront désormais précédés de subscribe.
    ->group(function(){
        Route::get('create',CreateController::class)->name('create');
        Route::post('store',StoreController::class)->name('store');
    });
});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
