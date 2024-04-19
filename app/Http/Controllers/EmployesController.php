<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use Illuminate\Http\Request;

class EmployesController extends Controller
{
    public function index()
    {
        $employes=Employes::where('etat',0)->get();
        $arch=0;
        return view('pages.employe.index',compact('employes','arch'));
    }

    public function indexArch()
    {
        $employes=Employes::where('etat',1)->get();
        $arch=1;
        return view("pages.employe.index",compact('employes','arch'));
    }

    public function store(Request $request)
    {
        Employes::create($request->all());
        return redirect()->route('employes.index');
    }

    public function show(Employes $employes)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $employe=Employes::find($id);
        $employe->update($request->all());
        return redirect()->route('employes.index');
    }

    public function destroy(Employes $employes)
    {
        //
    }

    public function archive($id,$val){
        $employe=Employes::find($id);
        $employe->etat = $val;
        $employe->update();
        return redirect()->route('employes.index');
    }
}
