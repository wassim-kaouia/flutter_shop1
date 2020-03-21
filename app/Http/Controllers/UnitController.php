<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;
use Session;

class UnitController extends Controller
{

    public function index()
    {
        return view('admin.units/units', ['units' => Unit::paginate(env('PAGINATION_COUNT'))]);
    }
    private function unitNameExists($unitName)
    {
        $unit = Unit::where(
            'unit_name', '=', $unitName
        )->first();

        if (!is_null($unit)) {
            Session::flash('status', 'Unit Name Already Existed!');
            return false;
        }
        return true;
    }

    private function unitCodeExists($unitCode)
    {
        $unit = Unit::where(
            'unit_code', '=', $unitCode
        )->first();

        if (!is_null($unit)) {
            Session::flash('status', 'Unit Code Already Existed!');
            return false;
        }
        return true;

    }
    public function store(Request $request)
    {

        //validate the forms by their names
        $request->validate([
            'unit-name' => 'required',
            'unit-code' => 'required',
        ]);

        $unitName = $request->input('unit-name');
        $unitCode = $request->input('unit-code');

        if (!$this->unitNameExists($unitName)) {
            return redirect()->back();
        }
        if (!$this->unitCodeExists($unitCode)) {
            return redirect()->back();
        }

        $unit = new Unit();

        $unit->unit_name = $unitName;
        $unit->unit_code = $unitCode;
        $unit->save();

        $request->session()->flash('status', 'Unit Added !');

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $id = $request->input('edit_id');
        $request->validate([
            'unit-name-update' => 'required',
            'unit-code-update' => 'required',
        ]);

        $unitName = $request->input('unit-name-update');
        $unitCode = $request->input('unit-code-update');

        if (!$this->unitNameExists($unitName)) {
            return redirect()->back();
        }
        if (!$this->unitCodeExists($unitCode)) {
            return redirect()->back();
        }

        $unit = Unit::findOrFail($id);
        $unit->unit_name = $unitName;
        $unit->unit_code = $unitCode;
        $unit->save();

        Session::flash('status', 'Unit Updated');

        return redirect()->back();

    }

    public function delete(Request $request)
    {

        $id = $request->input('delete_id');
        if (is_null($id) || empty($id)) {
            $request->session()->flash('status', 'Unit Is Required !');
            return redirect()->back();
        }

        $unit = Unit::findOrFail($id);

        $unit->delete();

        $request->session()->flash('status', 'Unit Deleted !');

        return redirect()->back();

    }

}
