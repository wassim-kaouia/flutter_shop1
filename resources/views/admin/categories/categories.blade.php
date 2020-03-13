@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Categories:</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($categories as $category)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                 <p>{{$category->name}} </p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no category found</p>
                         @endforelse
                         {{ $categories->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection