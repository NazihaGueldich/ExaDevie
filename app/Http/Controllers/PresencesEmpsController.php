<?php

namespace App\Http\Controllers;

use App\Models\PresencesEmps;
use App\Models\Employes;
use App\Models\Demndcongs;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class PresencesEmpsController extends Controller
{
    public function index()
    {
    }

    public function indexEmpl()
    {
        $user = Auth::user();
        $employe=Employes::where('email',$user->email)->first();
        $presences=PresencesEmps::where('id_employe',$employe->id)->get();
        $conjs=Demndcongs::where('id_employe',$employe->id)->where('etat',1)->get();
        return view('pages.employe.presence',compact('presences','presences','conjs'));
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
