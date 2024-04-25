<?php

namespace App\Http\Controllers;

use App\Models\PresencesEmps;
use App\Models\Employes;
use App\Models\Demndcongs;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Illuminate\Support\Facades\Auth;

class PresencesEmpsController extends Controller
{
    public function index()
    {

    }
    public function indexAdmin($id)
    {
        $employe=Employes::find($id);
        $presences=PresencesEmps::where('id_employe',$id)->get();
        $conjs=Demndcongs::where('id_employe',$id)->where('etat',1)->get();
        return view('pages.employe.presence',compact('presences','conjs','employe'));
    }
    

    public function indexEmpl()
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        $presences=PresencesEmps::where('id_employe',$employe->id)->get();
        $conjs=Demndcongs::where('id_employe',$employe->id)->where('etat',1)->get();
        return view('pages.employeblade.presence',compact('presences','conjs'));
    }

    public function historiqueEmpl()
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        $presences=PresencesEmps::where('id_employe',$employe->id)->where('etat',0)->count();
        $absences=PresencesEmps::where('id_employe',$employe->id)->where('etat',1)->count();
        $nbjConj=Demndcongs::where('id_employe',$employe->id)->where('etat',1)->count();
        return view('pages.employeblade.histempl',compact('absences','presences','nbjConj'));
    }
    
    public function historiqueDetEmpl($id)
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        if($id==0){
            $titre='Historique De Présence';
            $datas=PresencesEmps::where('id_employe',$employe->id)->where('etat',0)->get();
        }else if($id==1){
            $titre="Historique D'Absences";
            $datas=PresencesEmps::where('id_employe',$employe->id)->where('etat',1)->get();
        }else{
            $titre='Historique De Conjé';
            $datas=Demndcongs::where('id_employe',$employe->id)->where('etat',1)->get();
        }
        return view('pages.employeblade.histdetempl',compact('titre','datas','id'));
    }

    public function historiqueEmplAdm($id)
    {
        $employe=Employes::find($id);
        $presences=PresencesEmps::where('id_employe',$id)->where('etat',0)->count();
        $absences=PresencesEmps::where('id_employe',$id)->where('etat',1)->count();
        $nbjConj=Demndcongs::where('id_employe',$id)->where('etat',1)->count();
        return view('pages.employe.histempl',compact('absences','presences','nbjConj','employe'));
    }
    
    public function historiqueDetEmplAdm($emp,$id)
    {
        $user = Auth::user();
        $employe=Employes::find($emp);
        if($id==0){
            $titre='Historique De Présence';
            $datas=PresencesEmps::where('id_employe',$emp)->where('etat',0)->get();
        }else if($id==1){
            $titre="Historique D'Absences";
            $datas=PresencesEmps::where('id_employe',$emp)->where('etat',1)->get();
        }else{
            $titre='Historique De Conjé';
            $datas=Demndcongs::where('id_employe',$emp)->where('etat',1)->get();
        }
        return view('pages.employe.histdetempl',compact('titre','datas','id','employe'));
    }


    public function store(Request $request)
    {
        $type=$request->type;
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        $dem=0;
        if($type==0){
            //bch n7sb dif de nombre de jours
            $timestampDP = strtotime($request->dateDP);
            $timestampFP = strtotime($request->dateFP);
            $secondsDifference = $timestampFP - $timestampDP;
            $nbj = $secondsDifference / (60 * 60 * 24);
            $nbj = (int)$nbj;
            //il date ili bch nzidou
            $date=$request->dateDP;
            for ($i = 0; $i <= $nbj; $i++) {
                //bch narah heka enhar sbt walla a7add
                $dayOfWeek = date("w", strtotime($date));
                if ($dayOfWeek != 0 && $dayOfWeek != 6) {
                    PresencesEmps::create([
                        'date' => $date,
                        'etat' => 0,
                        'id_employe' => $employe->id,
                    ]);
                }
                $date = date("Y-m-d", strtotime($date . " +1 day"));
            }
        }else if ($type==1){
             //bch n7sb dif de nombre de jours
             $timestampDA = strtotime($request->dateDA);
             $timestampFA = strtotime($request->dateFA);
             $secondsDifference = $timestampFA - $timestampDA;
             $nbj = $secondsDifference / (60 * 60 * 24);
             $nbj = (int)$nbj;
             //il date ili bch nzidou
             $date=$request->dateDA;
             for ($i = 0; $i <= $nbj; $i++) {
                 //bch narah heka enhar sbt walla a7add
                 $dayOfWeek = date("w", strtotime($date));
                 if ($dayOfWeek != 0 && $dayOfWeek != 6) {
                     PresencesEmps::create([
                         'date' => $date,
                         'etat' => 1,
                         'cause'=>$request->causeA,
                         'id_employe' => $employe->id,
                     ]);
                 }
                 $date = date("Y-m-d", strtotime($date . " +1 day"));
             }
        }else if ($type==2){
            Demndcongs::create([
                'dateD' => $request->dateDDC,
                'dateF' => $request->dateFDC,
                'cause'=>$request->causeDC,
                'id_employe' => $employe->id,
            ]);
            $dem=1;
        }
        return redirect()->route('presence_employe')->with([
            'dem' => $dem,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(PresencesEmps $presencesEmps)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PresencesEmps $presencesEmps)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PresencesEmps $presencesEmps)
    {
        //
    }
}
