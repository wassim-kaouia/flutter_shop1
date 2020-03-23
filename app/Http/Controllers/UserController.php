<?php

namespace App\Http\Controllers;
use Session;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
   public function index(){
       $users = User::with(['reviews','ticket','roles'])->paginate(env('PAGINATION_COUNT'));
       $roles = Role::all();
       $paginationState = true;

    //    return $users;
       return view('admin.customers.customers')->with([
           'customers' => $users,
           'pagState' => $paginationState,
           'roles'=> $roles,
       ]);
   }
   private function userNameOrEmailExists($smtng)
   {
       $user = User::where(
           'first_name', '=', $smtng
       )->orWhere('email', '=', $smtng)->first();

       if (!is_null($user)) {
           Session::flash('status', 'User Name or Email Already Existed!');
           return false;
       }
       return true;
   }

   public function store(Request $request)
   {
        // dd($request->all());
       //validate the forms by their names
       $request->validate([
           'user-first-name' => 'required',
           'user-last-name' => 'required',
           'user-email' => 'required',
           'user-password' => 'required',
           'user-phone' => 'required',
           'role-name' => 'required',
       ]);

    //    dd($request->all());
       $userFirstName = $request->input('user-first-name');
       $userLastName = $request->input('user-last-name');
       $userEmail = $request->input('user-email');
       $userPassword = $request->input('user-password');
       $userPhone = $request->input('user-phone');
       $userRole = $request->input('role-name');

       
    //    dd($userRole);

       if (!$this->userNameOrEmailExists($userFirstName)) {
           return redirect()->back();
       }
       if (!$this->userNameOrEmailExists($userEmail)) {
        return redirect()->back();
    }

       $role = Role::where('role','=',$userRole)->pluck('id');   
    //    dd($role->first());
       $user = new User();

       $user->first_name = $userFirstName;
       $user->last_name = $userLastName;
       $user->email = $userEmail;
       $user->password = $userPassword;
       $user->mobile = $userPhone;       
       $user->save();
       $user->roles()->sync([$role->first()]);

       $request->session()->flash('status', 'User Added !');

       return redirect()->back();
   }

   public function update(Request $request)
   {
       
       $id = $request->input('edit_id');
    //    dd($id);
       $request->validate([
           'user-first-name-update' => 'required',
           'user-last-name-update' => 'required',
           'user-email-update' => 'required',
           'user-password-update' => 'required',
           'user-phone-update' => 'required',
           'role-name-update' => 'required',
       ]);
       
       $userFirstName = $request->input('user-first-name-update');
       $userLastName = $request->input('user-last-name-update');
       $userEmail = $request->input('user-email-update');
       $userPassword = $request->input('user-password-update');
       $userPhone = $request->input('user-phone-update');
       $userRole = $request->input('role-name-update');

    //    dd($request->all());
     
       
       $user = User::findOrFail($id);
       $role = Role::findOrFail($userRole);
        // dd($role->role);

       $user->first_name = $userFirstName;
       $user->last_name = $userLastName;
       $user->email = $userEmail;
       $user->password = $userPassword;
       $user->mobile = $userPhone;       
       $user->save();
       $user->save();
       $user->roles()->sync([$role->id]);

       Session::flash('status', 'User Updated');

       return redirect()->back();

   }


   public function search(Request $request){
       // dd($request);
       $paginationState = false;
       $request->validate([
           'user_search' => 'required',
       ]);

       $searchTerm = $request->input('user_search');

       $users = User::with('roles')->where('first_name','like','%'.$searchTerm.'%')
                  ->get();//we use paginate because in index action we used the same id name units and we had paginatation
       //$role = $users->first()->roles->first()->id;
       $roles = Role::all();

       
       if(count($users)>0){
           return view('admin.customers.customers')->with([
               'customers' => $users,
               'roles' => $roles,
               'pagState' => $paginationState,
               ]);
       } 
     
       $request->session()->flash('status','This User Not Found !');
       return redirect()->route('users');
   }

   public function delete(Request $request)
   {

       $id = $request->input('delete_id');
       if (is_null($id) || empty($id)) {
           $request->session()->flash('status', 'User Is Required !');
           return redirect()->back();
       }

       $user = User::findOrFail($id);

       $user->delete();

       $request->session()->flash('status', 'User Deleted !');

       return redirect()->back();

   }

}

