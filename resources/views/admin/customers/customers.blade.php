@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Users:</h3>
               </div>
               <div class="card-body">

                <div class="card-body">
                    <div class="mb-4">
                        <form action="{{route('users')}}" method="POST" class="row">
                              @csrf                      
                                <div class="form-group col-md-12">
                                  <button class="btn btn-primary btn-block" id="add_user" type="submit">Add User</button>
                                </div>
                          </form>
                        </div>
                  <div class="row">
                      
                         @forelse ($customers as $user)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                <span class="button-spans">
                                    <span class="span_edit" 
                                      data-userid="{{$user->id}}" 
                                      data-user-fname="{{ $user->first_name}}"
                                      data-user-lname="{{ $user->last_name}}"
                                      data-user-email="{{ $user->email}}"
                                      data-user-password = "{{$user->password}}"
                                      data-user-phone="{{ $user->mobile}}" 
                                      data-user-role = "{{$user->first()->roles->first()->role}}"

                                     
                                      >  
                                         <a><i class="fa fa-pencil-square text-success"></i></a>
                                    </span>
                                    <span class="span_delete" data-userid="{{$user->id}}" data-user-fname="{{ $user->first_name}}">
                                        <a><i class="fa fa-trash text-danger"></i></a>
                                    </span>
                                </span>
                                <div class="user-info">
                                   @foreach ($user->roles as $role)
                                       @if ($role->role == 'nobis')
                                       <p style="color:red">Admin : {{$user->formattedName()}}</p>
                                       @else
                                       <p>User : {{$user->formattedName()}}</p>
                                       <p>Role : {{$role->role}}</p>
                                       @endif
                                   @endforeach
                                </div>
                              </div>
                              
                         </div>
                         @empty
                             <p>no user found</p>
                         @endforelse
                         {{ (!is_null($pagState) && $pagState) ? $customers->links() : '' }}
                      </div>
                      <form action="{{route('search-users')}}" method="GET">
                        @csrf
                          <div class="row">
                          <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="user_search" name="user_search" placeholder="Search for User" required>
                          </div>

                          <div class="form-group col-md-6">
                               <button type="submit" class="btn btn-primary">Search</button>
                          </div>
                      </div>
                      </form>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
 {{-- window we gonna use to confirm  deleting --}}
 <div class="modal modal-delete"  id="window-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">User Delete : </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="delete-message"></p>
        </div>
        <div class="modal-footer">
            <form action="{{route('users')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="delete_id" id="delete_id" />
                <button type="submit" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>

   

  {{-- window for adding user --}}
  <div class="modal" tabindex="-1" role="dialog" id="window-add">
    <div class="modal-dialog" role="document">
    <form action="{{route('users') }}" method="POST">
      @csrf
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add New User :</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="form-group col-md-12">
            <label for="user-first-name"> First Name :</label>
            <input type="text" class="form-control" id="user-first-name" name="user-first-name" placeholder="First Name" required>
          </div>
          <div class="form-group col-md-12">
            <label for="user-last-name"> last Name :</label>
            <input type="text" class="form-control" id="user-last-name" name="user-last-name" placeholder="Last Name" required>
          </div>
          <div class="form-group col-md-12">
            <label for="user-email"> Email :</label>
            <input type="email" class="form-control" id="user-email" name="user-email" placeholder="Email" required>
          </div>
          <div class="form-group col-md-12">
            <label for="user-password"> Password :</label>
            <input type="password" class="form-control" id="user-password" name="user-password" placeholder="Password" required>
          </div>
          <div class="form-group col-md-12">
            <label for="user-phone"> Mobile Phone :</label>
            <input type="text" class="form-control" id="user-phone" name="user-phone" placeholder="Phone Number" required>
          </div>
          <div class="form-group col-md-12">
            <label for="role-name">Role:</label>
          <select class="form-control" id="role-name" name="role-name">
            @foreach ($roles as $role)
                <option value="{{$role->role}}">{{$role->role}}</option>
            @endforeach
          </select>
        </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add User</button>
        </div>
      </div>
    </form>
    </div>
  </div>

 {{-- end window of adding user --}}

 {{-- window for updating user --}}
 <div class="modal" tabindex="-1" role="dialog" id="window-update">
  <div class="modal-dialog" role="document">
  <form action="{{route('users') }}" method="POST">
    @csrf
    @method('put')
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Update User :</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group col-md-12">
          <label for="user-first-name-update"> First Name :</label>
          <input type="text" class="form-control" id="user-first-name-update" name="user-first-name-update" placeholder="First Name" required>
        </div>
        <div class="form-group col-md-12">
          <label for="user-last-name-update"> last Name :</label>
          <input type="text" class="form-control" id="user-last-name-update" name="user-last-name-update" placeholder="Last Name" required>
        </div>
        <div class="form-group col-md-12">
          <label for="user-email-update"> Email :</label>
          <input type="email" class="form-control" id="user-email-update" name="user-email-update" placeholder="Email" required>
        </div>
        <div class="form-group col-md-12">
          <label for="user-password-update"> Password :</label>
          <input type="password" class="form-control" id="user-password-update" name="user-password-update" placeholder="Password" required>
        </div>
        <div class="form-group col-md-12">
          <label for="user-phone-update"> Mobile Phone :</label>
          <input type="text" class="form-control" id="user-phone-update" name="user-phone-update" placeholder="Phone Number" required>
        </div>
        <div class="form-group col-md-12">
          <label for="role-name">Role:</label>
        <select class="form-control" id="role-name-update" name="role-name-update">
        
          @foreach ($roles as $role)
              
                 <option value="{{$role->id}}">{{$role->role}}</option>
                 
          @endforeach
        </select>
      </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" name="edit_id" id="edit_id">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Update User</button>
      </div>
    </div>
  </form>
  </div>
</div>

{{-- end window of updating user --}}

    {{-- my new toast --}}
        <div class="toast" data-delay="5000" style="position: absolute; top: 30px; right: 30px;">
          <div class="toast-header">
            <strong class="mr-auto">User:</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="toast-body">
             <span>
                 {{ session()->get('status') }}
             </span>
         </div>
        </div>
      

@endsection


@section('scripts')

<script>
    $(document).ready(function(){
        //$ before deleteUnit means we store an element not a mumber or character
        var $deleteUser = $('.span_delete');
    
        var $deleteWindow = $('#window-delete');
        var $userId = $('#delete_id');// we brought the ancr element field to fill it's valye
        var $deleteMessage = $('#delete-message'); // we brought the anc element field to fill it's value

        $deleteUser.on('click',function(element){
            element.preventDefault(); // we put it in the default state without any y movments 
            var userId = $(this).data('userid'); // we brought the value of current ancr by using $this and we brought the according Id
            var userFname = $(this).data('user-fname');
            $userId.val(userId); // set the value of ancr element into the value coming from data-unitid
            $deleteMessage.text('Do You Want To Delete ('+userFname+') ?');

            $deleteWindow.modal('show'); // show the modal delete 
        });

        var $editWindow = $('#window-update');
        var $editUser = $('.span_edit');
        var $id_user = $('#edit_id');
        

        $editUser.on('click',function(element){
            element.preventDefault(); 
            var userId = $(this).data('userid');
            var userFname = $(this).data('user-fname');
            var userLname = $(this).data('user-lname');
            var userEmail = $(this).data('user-email');
            var userPhone = $(this).data('user-phone');
            var userPassword = $(this).data('user-password');
            var userRole = $(this).data('user-role');
             
            $id_user.val(userId);

            console.log(userId);
            $('#user-first-name-update').val(userFname);
            $('#user-last-name-update').val(userLname);
            $('#user-email-update').val(userEmail);
            $('#user-password-update').val(userPassword);
            $('#user-phone-update').val(userPhone);
            $('#user-role-update').val(userRole);
          
            
            $editWindow.modal('show');
        });

        var $addUserBtn = $('#add_user');
        var $addWindow = $('#window-add');
        
        $addUserBtn.on('click',function(element){
          element.preventDefault();
          // alert('test btn add user'); //works
          $addWindow.modal('show');
        });

      

    });
</script>
 
@if (session()->has('status'))
    <script>
        $(document).ready(function(){
            $('.toast').toast('show');
        });
    </script>
@endif
@endsection