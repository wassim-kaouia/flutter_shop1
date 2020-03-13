<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{

   public function index(){
       return view('admin.units/units',['units'=> Unit::paginate(env('PAGINATION_COUNT'))]);
   }
}
