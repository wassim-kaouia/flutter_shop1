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
                <div class="mb-4">
                    <form action="{{route('categories')}}" method="POST" class="row">
                          @csrf
                          <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="category-name" name="category-name" placeholder="Category Name" required>
                            </div>

                            <div class="form-group col-md-6">
                              <button class="btn btn-primary btn-block" type="submit">Add Category</button>
                            </div>
                      </form>
                    </div>
                    <div class="row">
                        @forelse ($categories as $category)
                        <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
                             <div class="alert alert-primary" role="alert">
                                <span class="button-spans">
                                    <span class="span_edit" data-categoryid="{{$category->id}}" data-category-name="{{ $category->name}}">
                                         <a><i class="fa fa-pencil-square text-success"></i></a>
                                    </span>
                                    <span class="span_delete" data-categoryid="{{$category->id}}" data-category-name="{{ $category->name}}">
                                        <a><i class="fa fa-trash text-danger"></i></a>
                                    </span>
                                </span>
                                <p>{{(count($categories) > 0) ? $category->name : 'No Items To See'}}</p>
                             </div>
                             
                        </div>
                        @empty
                            <p>no category found</p>
                        @endforelse
                        {{ (!is_null($pagState) && $pagState) ? $categories->links() : '' }}

                      
                     </div>

                     <form action="{{route('search-categories')}}" method="GET">
                        @csrf
                          <div class="row">
                          <div class="form-group col-md-6">
                              <input type="text" class="form-control" id="category_search" name="category_search" placeholder="Search for Category" required>
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
          <h5 class="modal-title">Category Delete : </h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p id="delete-message"></p>
        </div>
        <div class="modal-footer">
            <form action="{{route('categories')}}" method="POST">
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
          <h5 class="modal-title">Edit Category :</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('categories')}}" method="POST">
        <div class="modal-body">
            @csrf
            @method('PUT')
            <div class="form-group col-md-12">
                <label for="tag-update">Category Name :</label>
                <input type="text" name="category-update" id="category-update" class="form-controller"  required />
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
            <strong class="mr-auto">Category:</strong>
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
        var $deleteCategory = $('.span_delete');
    
        var $deleteWindow = $('#window-delete');
        var $categoryId = $('#delete_id');// we brought the ancr element field to fill it's valye
        var $deleteMessage = $('#delete-message'); // we brought the anc element field to fill it's value

        $deleteCategory.on('click',function(element){
            element.preventDefault(); // we put it in the default state without any y movments 
            var categoryId = $(this).data('categoryid'); // we brought the value of current ancr by using $this and we brought the according Id
            var categoryName = $(this).data('category-name');
            $categoryId.val(categoryId); // set the value of ancr element into the value coming from data-unitid
            $deleteMessage.text('Do You Want To Delete ('+categoryName+') ?');

            $deleteWindow.modal('show'); // show the modal delete 
        });

        var $editWindow = $('#window-edit');
        var $editCategory = $('.span_edit');
        var $id_category = $('#edit_id');
        

        $editCategory.on('click',function(element){
            element.preventDefault(); 
            var categoryId = $(this).data('categoryid');
            var categoryName = $(this).data('category-name');

            $id_category.val(categoryId);

            // console.log(unitId);
            $('#category-update').val(categoryName);
        
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