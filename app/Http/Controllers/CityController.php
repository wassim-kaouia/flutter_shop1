<?php

namespace App\Http\Controllers;

use App\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    public function index(){
        $cities = City::paginate(env('PAGINATION_COUNT'));

        return view('admin.cities.cities')->with([
           'cities' => $cities,
        ]);
    }
}
