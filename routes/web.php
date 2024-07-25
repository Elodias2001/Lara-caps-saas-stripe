<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Suscribe\CreateController;
use App\Http\Controllers\Suscribe\DestroyController;
use App\Http\Controllers\Suscribe\StoreController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function(){

    Route::get('/dashboard', DashboardController::class)->name('dashboard');
    Route::get('/user/invoice/{invoice}', function (Request $request, string $invoiceId) {
        return $request->user()->downloadInvoice($invoiceId);
    })->name('invoices');

    Route::prefix('subscribe') // Pour le prefix url de mes routes
        ->as('subscribe.') // Pour le nom de mes routes qui seront désormais précédés de subscribe.
        ->middleware('redirect.subscribe') // (Si la personne a souscrire à un abonnement redirige le sur le dashboard qu'il n'accède pas aux routes ici) Pour appeler le middleware comme ça il faut lui créer un alias dans le app du dossier bootstrap
        ->group(function(){
            Route::get('create',CreateController::class)->name('create');
            Route::post('store',StoreController::class)->name('store');
            Route::delete('destroy',DestroyController::class)->name('destroy')->withoutMiddleware('redirect.subscribe');
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
// return $request->user()->downloadInvoice($invoiceId, [
//     'vendor' => 'Your Company',
//     'product' => 'Your Product',
//     'street' => 'Main Str. 1',
//     'location' => '2000 Antwerp, Belgium',
//     'phone' => '+32 499 00 00 00',
//     'email' => 'info@example.com',
//     'url' => 'https://example.com',
//     'vendorVat' => 'BE123456789',
// ]);
