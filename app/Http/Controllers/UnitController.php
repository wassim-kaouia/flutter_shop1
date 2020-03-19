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
           'unit-name' => 'required',
           'unit-code' => 'required',
       ]);
    
       $unit = new Unit();

       $unit->unit_name = $request->input('unit-name');
       $unit->unit_code = $request->input('unit-code');
       $unit->save();

       $request->session()->flash('status','Unit Added !');

       return redirect()->back(); 
   }

   public function update(Request $request){

        $request->validate([
            'unit-name-update' => 'required',
            'unit-code-update' => 'required',
        ]);
        
        $id = $request->input('edit_id');

        $unit = Unit::findOrFail($id);
        $unit->unit_name= $request->input('unit-name-update');
        $unit->unit_code= $request->input('unit-code-update');   
        $unit->save();

        $request->session()->flash('status','Unit Updated');

        return redirect()->back();

   }


   public function delete(Request $request){

         $id = $request->input('delete_id');
         if(is_null($id) || empty($id)){
            $request->session()->flash('status','Unit Is Required !');
            return redirect()->back();
         }

         $unit = Unit::findOrFail($id);
        
        $unit->delete();

        $request->session()->flash('status','Unit Deleted !');

        return redirect()->back(); 

   }

}
