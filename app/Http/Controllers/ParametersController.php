<?php

namespace App\Http\Controllers;

use App\Models\Parameters;
use Illuminate\Http\Request;

class ParametersController extends Controller
{
    
    public function index()
    {
        $find=0;
        if(Parameters::count() == 0){
            $find=0;
        } else {
            $find=1; 
        }
        $parameters=Parameters::all();
        return view('pages.parameter',compact('parameters','find'));
    }

    
    public function store(Request $request)
    {
        $logoName='';
        //enregistrer img dans le dossier public/images
        if($file = $request->hasFile('logo')){
            $logoName= time().'.'.$request->logo->extension();
            $request->logo->move(public_path('images'),$logoName);
        }
        $request = array_merge($request->except('logo'),['logo'=>$logoName]);
        Parameters::create($request); 
 
        return redirect()->route('parameter.index'); 
    }

    
    public function show(Parameters $parameters)
    {
        //
    }

    
    public function update(Request $request,$id)
    {
        $parameter=Parameters::find($id);
        $logoName="";
        if($file = $request->hasFile('logo')){
          $logoName= time().'.'.$request->logo->extension();
          $request->logo->move(public_path('images'),$logoName);
          $request = array_merge($request->except('logo'),['logo'=>$logoName]);
          $parameter->update($request);
        }else{
            $parameter->update($request->except('logo'));
        }
        return redirect()->route('parameter.index'); 
    }


    public function destroy(Parameters $parameters)
    {
        //
    }
}
