@extends('layouts.app')



@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
           <div class="card">
               <div class="card-header">
                   <h3>Products:</h3>
               </div>
               <div class="card-body">
                  <div class="row">
                      
                         @forelse ($products as $product)
                         <div class="col-md-4">
                              <div class="alert alert-primary" role="alert">
                                 <p>{{$product->title}} </p>
                                 <p>Category:{{$product->category->name}} </p>
                              <p>Price : {{$product->price}} {{$currency}}</p>
                              <p>Total Available : {{$product->total}}</p>
                              {{-- fach tan dero . tay 3ni concatination o fach tan dero ''tat 3ny text l ghay t9ra bsbab{!! 3la anaho html --}}
                              {!! (count($product->images) > 0) ? '<img class="img-thumbnail card-img" src="'.$product->images[0]->url.'"/>' : '<img class="img-thumbnail card-img" src="https://makitweb.com/demo/broken_image/images/noimage.png" />'  !!}  
                              </div>
                              
                         </div>
                         @empty
                             <p>no categproductory found</p>
                         @endforelse
                         {{ $products->links() }}
                      </div>
                  </div>
               </div>
           </div>    
        </div>
    </div>
</div>
@endsection