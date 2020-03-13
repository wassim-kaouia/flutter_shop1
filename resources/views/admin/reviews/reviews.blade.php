@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Reviews:</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($reviews as $review)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                 <p>Review : {{$review->review}} </p>
                              <p>Stars :
                                  @for ($i = 0; $i < $review->stars; $i++)
                                       <span class="fa fa-star"></span>
                                  @endfor
                                  @for ($i = 0; $i < (5-($review->stars)); $i++)
                                       <span class="fa fa-star-o"></span>
                                  @endfor
                              </p>
                              <p>Product Name : {{$review->product->title}}</p>
                              <p>User Name : {{$review->customer->formattedName()}}</p>
                              <p>Date :{{$review->created_at->diffForHumans()}}</p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no review found</p>
                         @endforelse
                         {{ $reviews->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection