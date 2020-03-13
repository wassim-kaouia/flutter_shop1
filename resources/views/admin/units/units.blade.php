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
                      <div class="mb-4">
                      <form action="{{route('units')}}" method="POST" class="row">
                            @csrf
                            <div class="form-group col-md-6">
                                <label for="unit_name">Unit Name : </label>
                                <input type="text" class="form-control" id="unit_name" name="unit_name" placeholder="Unit Name" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="unit_code">Unit Code : </label>
                                <input type="text" class="form-control" id="unit_code" name="unit_code" placeholder="Unit Code" required>
                              </div>

                              <div class="form-group col-md-12">
                                <button class="btn btn-primary btn-block" type="submit">Add Unit</button>
                              </div>
                        </form>
                      </div>
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