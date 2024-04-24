<?php

namespace App\Http\Controllers;

use App\Models\PresencesEmps;
use App\Models\Employes;
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
        $presences=PresencesEmps::find($employe->id);
        return view('pages.employe.presence',compact('presences'));
    }

    public function store(Request $request)
    {
        //
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
