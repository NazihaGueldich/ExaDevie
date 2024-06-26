<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProduitsController;
use App\Http\Controllers\ParametersController;
use App\Http\Controllers\ClientsController;
use App\Http\Controllers\DevisController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployesController;
use App\Http\Controllers\HistpaymtsController;
use App\Http\Controllers\PresencesEmpsController;
use App\Http\Controllers\DemndcongsController;
use App\Http\Controllers\PayementfactsController;
use App\Http\Controllers\HistcaissesController;
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
    Route::get('Employe/inpayer', [EmployesController::class, 'unpayerEmpl'])->name('Employe.unpayer'); 

    //payement
    Route::resource("histpaymts", HistpaymtsController::class);

    //presence
    Route::get('presenceEmpl_afficher/{id}', [PresencesEmpsController::class, 'indexAdmin'])->name('presenceEmpl.afficher');

    //demande conjé
    Route::resource("demandeConge", DemndcongsController::class);
    Route::get('Demande/etat/{id}/{val}', [DemndcongsController::class, 'etat'])->name('Demande.etat');

    //payement facture
    Route::resource("paymtsfacts", PayementfactsController::class);

    //historique caisse
    Route::resource("histcaisse", HistcaissesController::class);


    //blade employe
    //dashboard
    Route::get('Welcame_Employe', [DashboardController::class, 'indexEmpl'])->name('Welcame_Employe');
    Route::get('historiquepresenceemploye/{id}', [PresencesEmpsController::class, 'historiqueEmplAdm'])->name('historiquepresenceemploye');
    Route::get('historiquedetaillepresenceemploye/{emp}/{id}', [PresencesEmpsController::class, 'historiqueDetEmplAdm'])->name('historiquedetaillepresenceemploye');

    //presence
    Route::resource("presenceEmpl", PresencesEmpsController::class);
    Route::get('presence_employe', [PresencesEmpsController::class, 'indexEmpl'])->name('presence_employe');
    Route::get('historique_presence_employe', [PresencesEmpsController::class, 'historiqueEmpl'])->name('historique_presence_employe');
    Route::get('historique_detaille_presence_employe/{id}', [PresencesEmpsController::class, 'historiqueDetEmpl'])->name('historique_detaille_presence_employe');

    //demande conge
    Route::get('demande_Conge', [DemndcongsController::class, 'indexEmpl'])->name('demande_Conge');

    //edit information
    Route::get('Employe/modifier', [EmployesController::class, 'edit'])->name('employes.edit');
    Route::post('Employe/update', [EmployesController::class, 'updateInf'])->name('employes.modifier');

    //historique caisse
    Route::get('Employe/caisse', [HistcaissesController::class, 'indexEmp'])->name('employes.caisse');
});
require __DIR__.'/auth.php';
