<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployesController;
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
    Route::get('Clients/archivee', [ClientsController::class, 'indexArch'])->name('Client.archivee');

    //devis
    Route::resource("devis", DevisController::class);
    Route::get('devis/refuser/{id}', [DevisController::class, 'refuser'])->name('devis.refuser');
    Route::get('devis_PDF/{id}', [DevisController::class, 'devipdf'])->name('devis.pdf');
    Route::get('devis/en_cours', [DevisController::class, 'indexEC'])->name('devis.en_cours');
    Route::get('devis/accepter', [DevisController::class, 'indexA'])->name('devis.accepter');
    Route::get('devis/clients/{id}', [DevisController::class, 'DevClt'])->name('devis.clients');

    //factures
    Route::resource("factures", FacturesController::class);
    Route::get('factures_PDF/{id}', [FacturesController::class, 'facturepdf'])->name('factures.pdf');
    Route::get('factures/détails/{id}', [FacturesController::class, 'details'])->name('factures.details');
    Route::post('factures/ajouter', [FacturesController::class, 'ajout'])->name('factures.add');
    Route::get('factures/clients/{id}', [FacturesController::class, 'FactClt'])->name('factures.clients');

    //dashboard
    Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');

    //employes
    Route::resource("employes", EmployesController::class);
    Route::get('Employe/archive/{id}/{val}', [EmployesController::class, 'archive'])->name('Employe.archive');
    Route::get('Employe/archivee', [EmployesController::class, 'indexArch'])->name('Employe.archivee');

});
require __DIR__.'/auth.php';
