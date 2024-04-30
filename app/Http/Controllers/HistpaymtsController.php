<?php

namespace App\Http\Controllers;

use App\Models\Histpaymts;
use App\Models\Employes;
use App\Models\Emplinpays;
use Illuminate\Http\Request;

class HistpaymtsController extends Controller
{
    public function index()
    {
        $histpaymts=Histpaymts::all();
        $employes=Employes::where('etat',0)->get();
        return view('pages.employe.historique_payement',compact('histpaymts','employes'));
    }

    public function store(Request $request)
    {
        Histpaymts::create($request->all());
        $payement=Emplinpays::where('id_employe',$request->id_employe)->first();
        $payement->montant-=$request->virement;
        $payement->update();
        return redirect()->route('employes.index')->with([
            'success' => 1,
        ]);
    }

    public function show(Histpaymts $histpaymts)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $histpaymt=Histpaymts::find($id);
        $histpaymt->update($request->all());
        return redirect()->route('histpaymts.index');
    }

    public function destroy(Histpaymts $histpaymts)
    {
        //
    }
}
