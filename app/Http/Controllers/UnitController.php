<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{

   public function index(){
       return view('admin.units/units',['units'=> Unit::paginate(env('PAGINATION_COUNT'))]);
   }

   public function store(Request $request){
       
       //validate the forms by their names 
       $request->validate([
           'unit_name' => 'required',
           'unit_code' => 'required',
       ]);
    
       $unit = new Unit();

       $unit->unit_name = $request->input('unit_name');
       $unit->unit_code = $request->input('unit_code');
       $unit->save();

       $request->session()->flash('status','Unit Added !');

       return redirect()->back();

     
   }
}
