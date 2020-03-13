@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Tags</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($tags as $tag)
                         <div class="col-md-3">
                              <div class="alert alert-primary" role="alert">
                                 <p>{{$tag->tag}}</p>
                              </div>
                              
                         </div>
                         @empty
                             <p>no tag found</p>
                         @endforelse
                         {{ $tags->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection