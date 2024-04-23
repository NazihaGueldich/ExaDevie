<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use App\Models\Histpaymts;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\informtCmoptEmpl;

class EmployesController extends Controller
{
    public function index()
    {
        $employes=Employes::where('etat',0)->get();
        $arch=0;
        //e5er payement de chaqyue employé
        $latestPayments = Histpaymts::select('id_employe')
            ->selectRaw('MAX(date) as latest_date') 
            ->groupBy('id_employe')  
            ->orderByDesc('latest_date') 
            ->get();

        $currentDate = Carbon::now(); 
        $previousMonthDate = $currentDate->subMonth(); 

        $month = $previousMonthDate->format('m'); 
        $year = $previousMonthDate->format('Y'); 

        return view('pages.employe.index',compact('employes','arch','latestPayments','month','year'));
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
        $user = User::create([
            'name'=>$request->nom . ' ' . $request->pnom,
            'email' => $request->email,
            'password' => Hash::make($request->tel),
        ]);
        $data = [
            'email' => $request->email,
            'mdp' => $request->tel,
        ];
        \Mail::to($request->email)->send(new informtCmoptEmpl($data));
        return redirect()->route('employes.index');
    }

    public function show($id)
    {
        $employe=Employes::find($id);
        $histpaymts=Histpaymts::where('id_employe',$id)->get();
        return view('pages.employe.detail',compact('employe','histpaymts'));
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
