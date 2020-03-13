@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>States:</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($states as $state)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                 <p>State : {{$state->name}} </p>
                              <p>Country : {{$state->country->name}}</p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no state found</p>
                         @endforelse
                         {{ $states->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection