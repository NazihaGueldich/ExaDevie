<?php

namespace App\Http\Controllers;

use App\Models\Demndcongs;
use App\Models\Employes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class DemndcongsController extends Controller
{
    public function index()
    {
        //
    }

    public function indexEmpl()
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        $conjs=Demndcongs::where('id_employe',$employe->id)->get();
        return view('pages.employe.demandecong',compact('conjs'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        Demndcongs::create([
            'dateD' => $request->dateD,
            'dateF' => $request->dateF,
            'cause'=>$request->cause,
            'id_employe' => $employe->id,
        ]);
        return redirect()->route('demande_Conge');
    }

    public function show(Demndcongs $demndcongs)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $demande=Demndcongs::find($id);
        $demande->update($request->all());
        return redirect()->route('demande_Conge');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Demndcongs $demndcongs)
    {
        //
    }
}
