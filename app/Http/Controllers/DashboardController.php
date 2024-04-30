<?php

namespace App\Http\Controllers;

use App\Models\Factures;
use App\Models\Clients;
use App\Models\Devis;
use App\Models\Employes;
use App\Models\Caisses;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $nbclient=Clients::where('etat',0)->count();
        $nbclientTot=Clients::count();
        $nbdevC=Devis::where('etat',0)->count();
        $nbdevA=Devis::where('etat',1)->count();
        $nbdevR=Devis::where('etat',2)->count();
        $nbDev=Devis::count();
        $nbFact=Factures::count();

        $nbEmplC=Employes::where('etat',0)->count();
        $nbEmplTot=Employes::count();

        $nbfactS=Factures::whereNotNull('id_devi')->count();
        $nbfactP=Factures::whereNull('id_devi')->count();

        $end = Carbon::now();
        $start = Carbon::now()->subMonths(12);
        $gangeS = Factures::select(DB::raw('sum(MTTTC) as sum'), DB::raw('MONTH(created_at) month'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNotNull('id_devi')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        $gangeP = Factures::select(DB::raw('sum(MTTTC) as sum'), DB::raw('MONTH(created_at) month'))
            ->whereBetween('created_at', [$start, $end])
            ->whereNull('id_devi')
            ->groupBy('month')
            ->orderBy('month', 'asc')
            ->get();
        $months = [];
        $currentMonth = $start->copy();
        
        while ($currentMonth->lte($end)) {
            $months[] = $currentMonth->format('F');
            $currentMonth->addMonth();
        }

        $gangePMonths = $gangeP->map(function ($item) {
            return Carbon::createFromDate(null, $item->month)->format('F');
        })->toArray();

        $vgangeSMonths = $gangeS->map(function ($item) {
            return Carbon::createFromDate(null, $item->month)->format('F');
        })->toArray();
        $gangeSSums = $gangeS->pluck('sum')->toArray();
        $gangePSums = $gangeP->pluck('sum')->toArray();

        $caisse=Caisses::first();
        return view('dashboard',compact('caisse','nbclient','nbclientTot','nbEmplTot','nbEmplC','nbdevC','nbdevA','nbFact','nbdevR','nbDev','nbfactS','nbfactP','gangeS','gangeP','months','gangeSSums','gangePSums'));
    }

    public function indexEmpl()
    {
        return view('pages.employeblade.dashboard');
    }
}
