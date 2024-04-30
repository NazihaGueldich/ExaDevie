<?php

namespace App\Http\Controllers;

use App\Models\Employes;
use App\Models\Histpaymts;
use App\Models\Emplinpays;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\informtCmoptEmpl;

use Illuminate\Support\Facades\Auth;

class EmployesController extends Controller
{
    public function index()
    {
        $employes=Employes::where('etat',0)->get();
        $arch=0;
        $emplinpays=Emplinpays::where('etat',0)->get();
        return view('pages.employe.index',compact('employes','arch','emplinpays'));
    }

    public function indexArch()
    {
        $employes=Employes::where('etat',1)->get();
        $arch=1;
        $emplinpays=Emplinpays::where('etat',0)->get();
        return view("pages.employe.index",compact('employes','arch','emplinpays'));
    }

    public function store(Request $request)
    {
        Employes::create($request->all());
        $employe=Employes::where('email', $request->email)->first();
        $user = User::create([
            'name'=>$request->nom . ' ' . $request->pnom,
            'email' => $request->email,
            'password' => Hash::make($request->tel),
        ]);
        Emplinpays::create([
            'etat'=>0,
            'montant' => 0,
            'id_employe' => $employe->id,
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

    public function edit()
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        return view('pages.employeblade.editinfo',compact('employe'));
    }

    public function updateInf(Request $request)
    {
        $employe=Employes::find($request->id_emp);
        $employe->update($request->all());
        $employe=Employes::find($request->id_emp);
        return view('pages.employeblade.editinfo',compact('employe'));
    }
    

    
    public function destroy(Employes $employes)
    {
        //
    }

    public function archive($id,$val){
        $employe=Employes::find($id);
        $employe->etat = $val;
        $employe->update();
        $employeinp=Emplinpays::where('id_employe',$id)->first();
        $employeinp->etat = $val;
        $employeinp->update();      
        return redirect()->route('employes.index');
    }

    public function unpayerEmpl(){
        $employes_inpaye=Emplinpays::where('etat',0)->get();
        foreach ($employes_inpaye as $employe) {
            $emp=Employes::find($employe->id_employe);
            $employe->montant+=$emp->salaire;
            $employe->update();
        }
        return 'succes';
    }

}
