<?php

namespace App\Http\Controllers;

use App\Models\Clients;
use App\Models\Factures;
use App\Models\Devis;

use Illuminate\Http\Request;

class ClientsController extends Controller
{
    
    public function index()
    {
        $clients = Clients::where('etat',0)->get();
        $arch=0;
        return view("pages.client",compact('clients','arch'));
    }

    public function indexArch()
    {
        $clients = Clients::where('etat',1)->get();
        $arch=1;
        return view("pages.client",compact('clients','arch'));
    }

    
    public function store(Request $request)
    {
        Clients::create($request->all());
        return redirect()->route('client.index');
    }

    
    public function show($id)
    {
        $client=Clients::find($id);
        $nbfact=Factures::where('id_client',$id)->whereNull('id_devi')->count();
        $nbdev=Devis::where('id_client',$id)->count();
        return view("pages.detdevfact",compact('nbfact','nbdev','client'));
    }

    
    public function update(Request $request,$id)
    {
        $client=Clients::find($id);
        $client->update($request->all());
        return redirect()->route('client.index');
    }

    
    public function destroy(Clients $clients)
    {
        //
    }

    public function archive($id,$val){
        $client=Clients::find($id);
        $client->etat = $val;
        $client->update();
        return redirect()->route('client.index');
    }
}
