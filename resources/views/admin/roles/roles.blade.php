@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Roles:</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($roles as $role)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                              <p>Role : {{$role->role}}</p>
                              <p style="color:red">Users : 
                                  @foreach ($role->users as $user)
                              <h5>{{$user->formattedName()}}</h5>
                                  @endforeach    
                              </p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no role found</p>
                         @endforelse
                         {{ $roles->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection