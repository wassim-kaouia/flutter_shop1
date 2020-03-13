@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Cities:</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($cities as $city)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                 <p>City : {{$city->name}} </p>
                              <p>State : {{$city->state->name}}</p>
                              <p>Country : {{$city->country->name}}</p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no city found</p>
                         @endforelse
                         {{ $cities->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection