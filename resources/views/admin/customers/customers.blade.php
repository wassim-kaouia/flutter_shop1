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
                  <div class="row">
                      
                         @forelse ($customers as $user)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                   @foreach ($user->roles as $role)
                                       @if ($role->role == 'nobis')
                                       <p style="color:red">Admin : {{$user->formattedName()}}</p>
                                       @else
                                       <p>User : {{$user->formattedName()}}</p>
                                       @endif
                                   @endforeach
                                   
                              </div>
                              
                         </div>
                         @empty
                             <p>no user found</p>
                         @endforelse
                         {{ $customers->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection