@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Tickets:</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($tickets as $ticket)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                              <p>Title : {{$ticket->title}}</p>
                              <p>Status : {{$ticket->status}}</p>
                              <p>User : {{$ticket->customer->first_name}}</p>
                              <p>Type : {{$ticket->tickettype->name}}</p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no ticket found</p>
                         @endforelse
                         {{ $tickets->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection