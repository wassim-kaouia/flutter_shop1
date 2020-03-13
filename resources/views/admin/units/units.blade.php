@extends('layouts.app')


@section('content')
   <div class="container">
       <div class="row">
           <div class="col-md-12">
              <div class="card">
                  <div class="card-header">
                      <h3>Units</h3>
                  </div>
                  <div class="card-body">
                     <div class="row">
                         
                            @forelse ($units as $unit)
                            <div class="col-md-3">
                                 <div class="alert alert-primary" role="alert">
                                    <p>{{$unit->unit_name}} , {{$unit->unit_code}}</p>
                                 </div>
                                 
                            </div>
                            @empty
                                <p>no unit found</p>
                            @endforelse
                            {{ $units->links() }}
                         </div>
                     </div>
                  </div>
              </div>    
           </div>
       </div>
   </div>
    
@endsection