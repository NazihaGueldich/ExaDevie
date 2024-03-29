<?php

namespace App\Http\Controllers;

use App\Models\Produits;
use Illuminate\Http\Request;

class ProduitsController extends Controller
{
    public function index()
    {
        $produits = Produits::all();
        return view("pages.produit",compact('produits'));
    }

    
    public function store(Request $request)
    {
        Produits::create($request->all());
        return redirect()->route('produits.index');
    }

    
    public function show(Produits $produits)
    {
        //
    }

    public function update(Request $request,$id)
    {
        $produit=Produits::find($id);
        $produit->update($request->all());
        return redirect()->route('produits.index');
    }

    public function destroy($id)
    {
        $produit=Produits::find($id);
        $produit->delete();
        return redirect()->route('produits.index');
    }

    public function archive($id,$val){
        $produit=Produits::find($id);
        $produit->etat = $val;
        $produit->update();
        return redirect()->route('produits.index');
    }
}
