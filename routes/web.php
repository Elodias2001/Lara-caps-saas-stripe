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
        ->middleware('redirect.subscribe') // (Si la personne a souscrire à un abonnement redirige le sur le dashboard qu'il n'accède pas aux routes ici) Pour appeler le middleware comme ça il faut lui créer un alias dans le app du dossier bootstrap
        ->group(function(){
            Route::get('create',CreateController::class)->name('create');
            Route::post('store',StoreController::class)->name('store');
    });

    Route::get('basic',fn()=> dd('basic access'))->name('basic')->middleware('redirect.not.subscribe'); // Si la personne n'a pas encore souscrire à un abonnement empêche le d'accéder à cette route et redirige le sur le dashboard
    Route::get('premium',fn()=> dd('premium access'))->name('premium')->middleware('redirect.not.premium'); // Si la personne n'a pas souscrire à un abonnement prémium empêche le d'accéder à cette route et redirige le sur le dashboard

});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
