<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(){
        $roles = Role::with(['users'])->paginate(env('PAGINATION_COUNT'));
    
        // return $roles;
        return view('admin.roles.roles')->with([
            'roles' => $roles,
        ]);
    }
}
