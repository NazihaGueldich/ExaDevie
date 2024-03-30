<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DevisController;
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

Route::middleware('auth')->group(function () {

    //produits
    Route::resource("produits", ProduitsController::class);
    Route::get('produits/archive/{id}/{val}', [ProduitsController::class, 'archive'])->name('produits.archive');

    //parameter
    Route::resource("parameter", ParametersController::class);

    //client
    Route::resource("client", ClientsController::class);
    Route::get('Clients/archive/{id}/{val}', [ClientsController::class, 'archive'])->name('Client.archive');

    //devis
    Route::resource("devis", DevisController::class);
    Route::get('devis/refuser/{id}', [DevisController::class, 'refuser'])->name('devis.refuser');
    Route::get('devis_PDF/{id}', [DevisController::class, 'devipdf'])->name('devis.pdf');

});
require __DIR__.'/auth.php';
