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
                <div class="mb-4">
                    <form action="{{route('tags')}}" method="POST" class="row">
                          @csrf
                          <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="tag-name" name="tag-name" placeholder="Tag Name" required>
                            </div>

                            <div class="form-group col-md-6">
                              <button class="btn btn-primary btn-block" type="submit">Add Tag</button>
                            </div>
                      </form>
                    </div>
                    <div class="row">
                        @forelse ($tags as $tag)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                             <div class="alert alert-primary" role="alert">
                                <span class="button-spans">
                                    <span class="span_edit" data-tagid="{{$tag->id}}" data-tag-name="{{ $tag->tag}}">
                                         <a><i class="fa fa-pencil-square text-success"></i></a>
                                    </span>
                                    <span class="span_delete" data-tagid="{{$tag->id}}" data-tag-name="{{ $tag->tag}}">
                                        <a><i class="fa fa-trash text-danger"></i></a>
                                    </span>
                                </span>
                                <p>{{(count($tags) > 0) ? $tag->tag : 'No Items To See'}}</p>
                             </div>
                             
                        </div>
                        @empty
                            <p>no tag found</p>
                        @endforelse
                        {{ (!is_null($pagState) && $pagState) ? $tags->links() : '' }}

                      
                     </div>

                     <form action="{{route('search-tags')}}" method="GET">
                        @csrf
                          <div class="row">
                          <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="tag_search" name="tag_search" placeholder="Search for Tag" required>
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
          <h5 class="modal-title">Tag Delete : </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="delete-message"></p>
        </div>
        <div class="modal-footer">
            <form action="{{route('tags')}}" method="POST">
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
        <form action="{{route('tags')}}" method="POST">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-group col-md-12">
                <label for="tag-update">Tag Name :</label>
                <input type="text" name="tag-update" id="tag-update" class="form-controller"  required />
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
            <strong class="mr-auto">Tag:</strong>
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
        var $deleteTag = $('.span_delete');
    
        var $deleteWindow = $('#window-delete');
        var $tagId = $('#delete_id');// we brought the ancr element field to fill it's valye
        var $deleteMessage = $('#delete-message'); // we brought the anc element field to fill it's value

        $deleteTag.on('click',function(element){
            element.preventDefault(); // we put it in the default state without any y movments 
            var tagId = $(this).data('tagid'); // we brought the value of current ancr by using $this and we brought the according Id
            var tagName = $(this).data('tag-name');
            $tagId.val(tagId); // set the value of ancr element into the value coming from data-unitid
            $deleteMessage.text('Do You Want To Delete ('+tagName+') ?');

            $deleteWindow.modal('show'); // show the modal delete 
        });

        var $editWindow = $('#window-edit');
        var $editTag = $('.span_edit');
        var $id_tag = $('#edit_id');
        

        $editTag.on('click',function(element){
            element.preventDefault(); 
            var tagId = $(this).data('tagid');
            var tagName = $(this).data('tag-name');

            $id_tag.val(tagId);

            // console.log(unitId);
            $('#tag-update').val(tagName);
        
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