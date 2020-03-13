@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Countries</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($countries as $country)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                 <p>{{$country->name}}</p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no country found</p>
                         @endforelse
                         {{ $countries->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection