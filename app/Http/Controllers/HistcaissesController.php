<?php

namespace App\Http\Controllers;

use App\Models\Histcaisses;
use App\Models\Caisses;
use App\Models\Employes;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class HistcaissesController extends Controller
{
    public function index()
    {
        $histcaisses=Histcaisses::all();
        return view('pages.caisse',compact('histcaisses'));
    }

    public function indexEmp()
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        $histcaisses=Histcaisses::where('id_user',$employe->id)->get();
        return view('pages.employeblade.caisse',compact('histcaisses'));
    }

    public function store(Request $request)
    {
        if($request->type==0){
            Histcaisses::create($request->all());
            $caisse=Caisses::first();
            $caisse->totale+=$request->prix;
            $caisse->update();
            return redirect()->route('histcaisse.index');
        }else{
            $user = Auth::user();
            $employe=Employes::where('email',$user->email)->first();
            Histcaisses::create([
                'description'=>$request->description,
                'type' => $request->type,
                'prix'=>$request->prix,
                'id_user' => $employe->id,
            ]);
            $caisse=Caisses::first();
            $caisse->totale-=$request->prix;
            $caisse->update();
            return redirect()->route('employes.caisse');
        }       
    }

    public function show(Histcaisses $histcaisses)
    {
        //
    }

    public function update(Request $request, $id)
    {dd(44);
        $histcaisse=Histcaisses::find($id);
        $oldvir=$histcaisse->prix;
        if($oldvir > $request->prix){
            $flouth=
            $oldvir - $request->prix;
        }else{
            $flouth=  $oldvir-$request->prix;
        }
        $caisse=Caisses::first();
        if($request->type==0){
            $caisse->totale-=$flouth;
            $histcaisse->update($request->all());
            $caisse->update();
            return redirect()->route('histcaisse.index');
        }else{
            $caisse->totale+=$flouth;
            $histcaisse->update($request->all());
            $caisse->update();
            return redirect()->route('employes.caisse');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Histcaisses $histcaisses)
    {
        //
    }
}
