<?php

namespace App\Http\Controllers;

use App\Models\Payementfacts;
use App\Models\Factures;
use Illuminate\Http\Request;

class PayementfactsController extends Controller
{
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Payementfacts::create($request->all());
        $facture=Factures::find($request->id_facture);
        $facture->rest-=$request->virement;
        $facture->update();
        return redirect()->route('factures.index')->with([
            'PymtSuccess' => 1,
        ]);
    }

    public function show($id)
    {
        $facture=Factures::find($id);
        $payementfacts=Payementfacts::where('id_facture',$id)->get();
        return view('pages.factures.histpayement',compact('facture','payementfacts'));
    }

    public function update(Request $request, $id)
    {
        $payementfacts=Payementfacts::find($id);
        $oldvir=$payementfacts->virement;
        $facture=Factures::find($payementfacts->id_facture);
        if($oldvir > $request->virement){
            $flouth=$oldvir - $request->virement;
        }else{
            $flouth=  $oldvir-$request->virement;
        }
        $facture->rest+=$flouth;
        $payementfacts->update($request->all());
        $facture->update();
        $payementfacts=Payementfacts::where('id_facture',$payementfacts->id_facture)->get();
        return view('pages.factures.histpayement',compact('facture','payementfacts'));    
    }

    public function destroy(Payementfacts $payementfacts)
    {
        //
    }
}
