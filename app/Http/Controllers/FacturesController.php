<?php

namespace App\Http\Controllers;

use App\Models\Factures;
use App\Models\Devis;
use App\Models\Produits;
use App\Models\Lignesdevis;
use App\Models\Ligniefactures;
use App\Models\Parameters;
use App\Models\Clients;
use Illuminate\Http\Request;
use PDF;

class FacturesController extends Controller
{
    public function index()
    {
        $factures=Factures::all();
        return view('pages.factures.index',compact('factures'));
    }

    public function store(Request $request)
    {
        $num=Factures::max('num');
        if($num===NULL){
            $num = 'ExaDev'.now()->year . 1;
        }else{
            $num= preg_replace('/[^0-9]/', '', $num);
            $num='ExaDev'.$num+1;
        }
        $facture = new Factures([
            'id_devi' => $request->input('devi_id'),
            'sujet' => $request->input('sujet'),
            'id_client' => $request->input('id_client'),
            'num' => $num,
            ]);
        $facture->save();
        $facture=Factures::find(Factures::max('id'));
        $idfacture=$facture->id;
        $indicLignieTab = explode(',', $request->indicLignie);
        foreach ($indicLignieTab as $i) {            
            $idptype = 'type' . $i;
            $type = $request->get($idptype);
            if($type==0){//produits
                $idproduit = 'id_produit' . $i;
                $id_produit = $request->get($idproduit);
                $produit=Produits::where('id',$id_produit)->first();
                $idquantiter = 'quantiter' . $i;
                $quantiter = $request->get($idquantiter);
                $ligniefact = new Ligniefactures([
                    'type' => 0,
                    'id_produit' => $id_produit,
                    'prix' => $produit->prixU,
                    'prixT' => $produit->prixU*$quantiter,
                    'tva' => $produit->tva,
                    'tht' => $produit->tht,
                    'ptttc' => $produit->ptttc,
                    'quantiter' => $quantiter,
                    'id_facture' => $idfacture,
                ]);
                $ligniefact->save();
                $this->MTHT($idfacture,$produit->tht);
                $this->MTTTC($idfacture,$produit->ptttc);
                $this->totTVA($idfacture,$produit->tva);
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
                $ligniefact = new Ligniefactures([
                    'type' => 1,
                    'designiation' => $designiation,
                    'prix' => $prix,
                    'prixT' => $prix,
                    'tva' => $tva,
                    'tht' => $tht,
                    'ptttc' => $ptttc,
                    'quantiter' => 1,
                    'id_facture' => $idfacture,
                ]);
                $ligniefact->save();
                $this->MTHT($idfacture,$tht);
                $this->MTTTC($idfacture,$ptttc);
                $this->totTVA($idfacture,$tva);
            }
        }
        $success = 1;
        return redirect()->route('devis.index')->with([
            'success' => $success,
            'idfacture' => $idfacture,
        ]);
    }

    //factorisation
    public function show($id)
    {
        $num=Factures::max('num');
        if($num===NULL){
            $num = 'ExaDev'.now()->year . 1;
        }else{
            $num= preg_replace('/[^0-9]/', '', $num);
            $num='ExaDev'.$num+1;
        }
        $devi=Devis::find($id);
        $ligniedevis=Lignesdevis::where('id_devi',$id)->get();
        $produits=Produits::where('etat',0)->get();
        $nblignie=$ligniedevis->count();
        $indicLignie = []; 

        for ($i = 1; $i <= $nblignie; $i++) {
            $indicLignie[] = $i; 
        }
        $indicLignie=implode(',', $indicLignie);
        return view('pages.factures.fatoriser',compact('devi','ligniedevis','produits','indicLignie'));
    }

    //details
    public function details($id)
    {
        $facture=Factures::find($id);
        $ligniefactures=Ligniefactures::where('id_facture',$id)->get();
        return view('pages.factures.detaille',compact('facture','ligniefactures'));
    }

    public function update(Request $request, Factures $factures)
    {
        
    }

    public function destroy(Factures $factures)
    {
        
    }

    public function MTHT($id,$prix){
        $facture=Factures::find($id);
        if(is_null($facture->MTHT)){
            $facture->MTHT = $prix;
        }else{
            $facture->MTHT = $facture->MTHT+$prix;
        }
        $facture->update();
    }

    public function MTTTC($id,$prix){
        $facture=Factures::find($id);
        $facture->MTTTC = $facture->MTTTC+$prix;
        $facture->update();
    }

    public function totTVA($id,$prix){
        $facture=Factures::find($id);
        $facture->totTVA = $facture->totTVA+$prix;
        $facture->update();
    }

    public function facturepdf($id){
        $facture=Factures::find($id);
        $ligniefactures=Ligniefactures::where('id_facture',$id)->get();
        $parameter=Parameters::first(); 
        $html = view('pages.factures.pdf',compact('facture','ligniefactures','parameter'))->render();
        $pdf = PDF::loadHTML($html);
        return $pdf->stream();
    }

    public function create()
    {
        $clients=Clients::where('etat',0)->get();
        $produits=Produits::where('etat',0)->get();
        $num=Factures::max('num');
        if($num===NULL){
            $num = 'ExaDev'.now()->year . 1;
        }else{
            $num= preg_replace('/[^0-9]/', '', $num);
            $num='ExaDev'.$num+1;
        }
        return view('pages.factures.add',compact('clients','produits','num'));
    }

    public function ajout(Request $request)
    {
        $num=Factures::max('num');
        if($num===NULL){
            $num = 'ExaDev'.now()->year . 1;
        }else{
            $num= preg_replace('/[^0-9]/', '', $num);
            $num='ExaDev'.$num+1;
        }
        $facture = new Factures([
            'id_devi' => $request->input('devi_id'),
            'sujet' => $request->input('sujet'),
            'id_client' => $request->input('id_client'),
            'num' => $num,
            ]);
        $facture->save();
        $facture=Factures::find(Factures::max('id'));
        $idfacture=$facture->id;
        $indicLignieTab = explode(',', $request->indicLignie);
        foreach ($indicLignieTab as $i) {
            $idptype = 'type' . $i;
            $type = $request->get($idptype);
            if($type==0){//produits
                $idproduit = 'id_produit' . $i;
                $id_produit = $request->get($idproduit);
                $produit=Produits::where('id',$id_produit)->first();
                $idquantiter = 'quantiter' . $i;
                $quantiter = $request->get($idquantiter);
                $ligniefact = new Ligniefactures([
                    'type' => 0,
                    'id_produit' => $id_produit,
                    'prix' => $produit->prixU,
                    'prixT' => $produit->prixU*$quantiter,
                    'tva' => $produit->tva,
                    'tht' => $produit->tht,
                    'ptttc' => $produit->ptttc,
                    'quantiter' => $quantiter,
                    'id_facture' => $idfacture,
                ]);
                $ligniefact->save();
                $this->MTHT($idfacture,$produit->tht);
                $this->MTTTC($idfacture,$produit->ptttc);
                $this->totTVA($idfacture,$produit->tva);
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
                $ligniefact = new Ligniefactures([
                    'type' => 1,
                    'designiation' => $designiation,
                    'prix' => $prix,
                    'prixT' => $prix,
                    'tva' => $tva,
                    'tht' => $tht,
                    'ptttc' => $ptttc,
                    'quantiter' => 1,
                    'id_facture' => $idfacture,
                ]);
                $ligniefact->save();
                $this->MTHT($idfacture,$tht);
                $this->MTTTC($idfacture,$ptttc);
                $this->totTVA($idfacture,$tva);
            }
        }
        $success = 1;
        return redirect()->route('factures.index')->with([
            'success' => $success,
            'idfacture' => $idfacture,
        ]);
    }
}
