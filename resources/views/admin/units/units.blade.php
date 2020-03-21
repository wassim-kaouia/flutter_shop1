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
                                <label for=#unit-name">Unit Name : </label>
                                <input type="text" class="form-control" id="unit-name" name="unit-name" placeholder="Unit Name" required>
                              </div>

                              <div class="form-group col-md-6">
                                <label for="unit_code">Unit Code : </label>
                                <input type="text" class="form-control" id="unit-code" name="unit-code" placeholder="Unit Code" required>
                              </div>

                              <div class="form-group col-md-12">
                                <button class="btn btn-primary btn-block" type="submit">Add Unit</button>
                              </div>
                        </form>
                      </div>
                     <div class="row">
                            @forelse ($units as $unit)
                            <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                                 <div class="alert alert-primary" role="alert">
                                    <span class="button-spans">
                                        <span class="span_edit" data-unitid="{{$unit->id}}" data-unit-name="{{ $unit->unit_name}}" data-unit-code="{{ $unit->unit_code}}">
                                             <a><i class="fa fa-pencil-square text-success"></i></a>
                                        </span>
                                        <span class="span_delete" data-unitid="{{$unit->id}}" data-unit-name="{{ $unit->unit_name}}">
                                            <a><i class="fa fa-trash text-danger"></i></a>
                                        </span>
                                    </span>
                                    <p>{{$unit->unit_name}} , {{$unit->unit_code}}</p>
                                 </div>
                                 
                            </div>
                            @empty
                                <p>no unit found</p>
                            @endforelse
                            {{ ($pagState && !is_null($pagState)) ? $units->links() : ''}}
                         </div>

                        
                        <form action="{{route('search-units')}}" method="get">
                              @csrf
                                <div class="row">
                                <div class="form-group col-md-6">
                                    <input type="text" class="form-control" id="unit_search" name="unit_search" placeholder="Search" required>
                                </div>

                                <div class="form-group col-md-6">
                                     <button type="submit" class="btn btn-primary">Search</button>
                                </div>
                            </div>
                            </form>
                        
                     </div>
                  </div>
              </div>    
           </div>
       </div>
   </div>


   {{-- window we gonna use to confirm  deleting --}}
   <div class="modal modal-delete"  id="window-delete" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Unit Delete : </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="delete-message"></p>
        </div>
        <div class="modal-footer">
            <form action="{{route('units')}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="delete_id" id="delete_id" />
                <button type="submit" class="btn btn-primary">Confirm</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            </form>
          
        </div>
      </div>
    </div>
  </div>

   {{-- window we gonna use to confirm editing  --}}
   <div class="modal modal-edit"  id="window-edit" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Edit Unit :</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('units')}}" method="POST">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-group text-center">
                <input type="text" name="unit-name-update" id="unit-name-update" class="form-controller"  required />
                <input type="text" name="unit-code-update" id="unit-code-update" class="form-controller"  required />
            </div>
           
       
        </div>
        <div class="modal-footer">
           <input type="hidden" name="edit_id" id="edit_id"> 
          <button type="submit" class="btn btn-primary">Update</button>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
       </form>
      </div>
    </div>
  </div>
  
  {{-- end of window --}}



    {{-- my new toast --}}
        <div class="toast" data-delay="5000" style="position: absolute; top: 30px; right: 30px;">
          <div class="toast-header">
            <strong class="mr-auto">Unit:</strong>
            <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="toast-body">
             <span>
                 {{ session()->get('status') }}
             </span>
         </div>
        </div>
      

@endsection


@section('scripts')

<script>
    $(document).ready(function(){
        //$ before deleteUnit means we store an element not a mumber or character
        var $deleteUnit = $('.span_delete');
    
        var $deleteWindow = $('#window-delete');
        var $unitId = $('#delete_id');// we brought the ancr element field to fill it's valye
        var $deleteMessage = $('#delete-message'); // we brought the anc element field to fill it's value

        $deleteUnit.on('click',function(element){
            element.preventDefault(); // we put it in the default state without any y movments 
            var unitId = $(this).data('unitid'); // we brought the value of current ancr by using $this and we brought the according Id
            var unitName = $(this).data('unit-name');
            $unitId.val(unitId); // set the value of ancr element into the value coming from data-unitid
            $deleteMessage.text('Do You Want To Delete ('+unitName+') ?');

            $deleteWindow.modal('show'); // show the modal delete 
        });

        var $editWindow = $('#window-edit');
        var $editUnit = $('.span_edit');
        var $id_unit = $('#edit_id');
        

        $editUnit.on('click',function(element){
            element.preventDefault(); 
            var unitId = $(this).data('unitid');
            var unitName = $(this).data('unit-name');
            var unitCode = $(this).data('unit-code');

            $id_unit.val(unitId);

            // console.log(unitId);
            $('#unit-name-update').val(unitName);
            $('#unit-code-update').val(unitCode);
            $editWindow.modal('show');
        });

    });
</script>
 
@if (session()->has('status'))
    <script>
        $(document).ready(function(){
            $('.toast').toast('show');
        });
    </script>
@endif
@endsection