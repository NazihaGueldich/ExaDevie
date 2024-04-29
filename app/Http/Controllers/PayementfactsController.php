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

    /**
     * Display the specified resource.
     */
    public function show(Payementfacts $payementfacts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Payementfacts $payementfacts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Payementfacts $payementfacts)
    {
        //
    }
}
