<?php

namespace App\Http\Controllers;

use App\Models\Devis;
use App\Models\Clients;
use App\Models\Produits;
use App\Models\Lignesdevis;
use Illuminate\Http\Request;

class DevisController extends Controller
{
    
    public function index()
    {
        $devis=Devis::all();
        return view('pages.devis.index',compact('devis'));
    }

    public function create(){
        $clients=Clients::where('etat',0)->get();
        $produits=Produits::where('etat',0)->get();
        return view('pages.devis.add',compact('clients','produits'));
    }

    public function store(Request $request)
    {
        $devi = new Devis([
            'sujet' => $request->input('sujet'),
            'id_client' => $request->input('id_client'),
            ]);
        $devi->save();
        $devi=Devis::find(Devis::max('id'));
        $iddevi=$devi->id;
        for ($i=1; $i <=$request->nblign ; $i++) {
            $idptype = 'type' . $i;
            $type = $request->get($idptype);
            if($type==0){//produits
                $idproduit = 'id_produit' . $i;
                $id_produit = $request->get($idproduit);
                $produit=Produits::where('id',$id_produit)->first();
                $idquantiter = 'quantiter' . $i;
                $quantiter = $request->get($idquantiter);
                $ligniedevi = new Lignesdevis([
                    'type' => 0,
                    'id_produit' => $id_produit,
                    'prix' => $produit->prixU,
                    'prixT' => $produit->prixU*$quantiter,
                    'tva' => $produit->tva,
                    'tht' => $produit->tht,
                    'ptttc' => $produit->ptttc,
                    'quantiter' => $quantiter,
                    'id_devi' => $iddevi,
                ]);
                $ligniedevi->save();
                $this->MTHT($iddevi,$produit->tht);
                $this->MTTTC($iddevi,$produit->ptttc);
                $this->totTVA($iddevi,$produit->tva);
            }else{
                $iddesigniation = 'designiation' . $i;
                $designiation = $request->get($iddesigniation);
                $idprix = 'prix' . $i;
                $prix = $request->get($idprix);
                $idtva = 'tva' . $i;
                $tva = $request->get($idtva);
                $idtht = 'tht' . $i;
                $tht = $request->get($idtht);
                $idptttc = 'ptttc' . $i;
                $ptttc = $request->get($idptttc);
                $ligniedevi = new Lignesdevis([
                    'type' => 1,
                    'designiation' => $designiation,
                    'prix' => $prix,
                    'prixT' => $prix,
                    'tva' => $tva,
                    'tht' => $tht,
                    'ptttc' => $ptttc,
                    'quantiter' => 1,
                    'id_devi' => $iddevi,
                ]);
                $ligniedevi->save();
                $this->MTHT($iddevi,$tht);
                $this->MTTTC($iddevi,$ptttc);
                $this->totTVA($iddevi,$tva);
            }
        }
        return redirect()->route('devis.index');
    }

    
    public function show($id)
    {
        $devi=Devis::find($id);
        $ligniedevis=Lignesdevis::where('id_devi',$id)->get();
        return view('pages.devis.details',compact('devi','ligniedevis'));
    }

    public function edit($id)
    {
        $produits=Produits::where('etat',0)->get();
        $clients=Clients::where('etat',0)->get();
        $devi=Devis::find($id);
        $ligniedevis=Lignesdevis::where('id_devi',$id)->get();
        $nblignie=$ligniedevis->count();
        return view('pages.devis.edit',compact('devi','produits','ligniedevis','clients','nblignie'));
    }
    
    public function update(Request $request, Devis $devis)
    {   
        //3malt update lil devis
        $devi=Devis::find($request->devi_id);
        $devi->update($request->all());
        //fsa5t les lignie li9domm
        Lignesdevis::where('id_devi', $request->devi_id)->delete();
        //sna3t des lignie jdod
        for ($i=1; $i <=$request->nblign ; $i++) {
            $idptype = 'type' . $i;
            $type = $request->get($idptype);
            if($type==0){//produits
                $idproduit = 'id_produit' . $i;
                $id_produit = $request->get($idproduit);
                $produit=Produits::where('id',$id_produit)->first();
                $idquantiter = 'quantiter' . $i;
                $quantiter = $request->get($idquantiter);
                $ligniedevi = new Lignesdevis([
                    'type' => 0,
                    'id_produit' => $id_produit,
                    'prix' => $produit->prixU,
                    'prixT' => $produit->prixU*$quantiter,
                    'tva' => $produit->tva,
                    'tht' => $produit->tht,
                    'ptttc' => $produit->ptttc,
                    'quantiter' => $quantiter,
                    'id_devi' => $request->devi_id,
                ]);
                $ligniedevi->save();
                $this->MTHT($request->devi_id,$produit->tht);
                $this->MTTTC($request->devi_id,$produit->ptttc);
                $this->totTVA($request->devi_id,$produit->tva);
            }else{
                $iddesigniation = 'designiation' . $i;
                $designiation = $request->get($iddesigniation);
                $idprix = 'prix' . $i;
                $prix = $request->get($idprix);
                $idtva = 'tva' . $i;
                $tva = $request->get($idtva);
                $idtht = 'tht' . $i;
                $tht = $request->get($idtht);
                $idptttc = 'ptttc' . $i;
                $ptttc = $request->get($idptttc);
                $ligniedevi = new Lignesdevis([
                    'type' => 1,
                    'designiation' => $designiation,
                    'prix' => $prix,
                    'prixT' => $prix,
                    'tva' => $tva,
                    'tht' => $tht,
                    'ptttc' => $ptttc,
                    'quantiter' => 1,
                    'id_devi' => $request->devi_id,
                ]);
                $ligniedevi->save();
                $this->MTHT($request->devi_id,$tht);
                $this->MTTTC($request->devi_id,$ptttc);
                $this->totTVA($request->devi_id,$tva);
            }
        }
        return redirect()->route('devis.index');
    }

    
    public function destroy(Devis $devis)
    {
        
    }

    public function refuser($id)
    {
        $devi = Devis::find($id);      
        $devi->etat = 2;
        $devi->save(); 
        return redirect()->route('devis.show', ['devi' => $id]);
    }



    public function MTHT($id,$prix){
        $devi=Devis::find($id);
        if(is_null($devi->MTHT)){
            $devi->MTHT = $prix;
        }else{
            $devi->MTHT = $devi->MTHT+$prix;
        }
        $devi->update();
    }

    public function MTTTC($id,$prix){
        $devi=Devis::find($id);
        $devi->MTTTC = $devi->MTTTC+$prix;
        $devi->update();
    }

    public function totTVA($id,$prix){
        $devi=Devis::find($id);
        $devi->totTVA = $devi->totTVA+$prix;
        $devi->update();
    }
}