<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
       $users = User::with(['reviews','ticket','roles'])->paginate(env('PAGINATION_COUNT'));

    //    return $users;
       return view('admin.customers.customers')->with([
           'customers' => $users,
       ]);
   }
}
