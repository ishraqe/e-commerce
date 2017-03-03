@extends('layouts.master')
@section('title')
Wishlist
@endsection
   
@section('content')
<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @if(!Auth::guest())
        @if(is_null($wishlist))
            <h2>No, items in wishlist</h2>
        @else
            @foreach($wishlist as $w)
             
            <?php 
              $product= \App\Product::where('id',$w->product_id)->get();

            ?>
                
                @foreach($product as $p)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$p->image}}" alt="" />
                                        <h2>${{$p->price}}</h2>
                                        <p>{{$p->title}}</p>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$p->price}}</h2>
                                            <p>{{$p->title}}</p>
                                            <a href="{{route('product.addToCart',['id'=>$p->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            <a href="{{action('ProductController@show',[$p->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">

                                    <li><a href="{{route('product.addToWishlist',['id'=>$p->id])}}"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                @endforeach       
             
          
                  
            @endforeach
        @endif
    @else
     @if(Session::has('wish'))
         
            @foreach($product as $products)
                  
                   
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="{{$products['item']->image}}" alt="" />

                                        <h2>${{$products['item']->price}}</h2>
                                        <p>{{$products['item']->title}}</p>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>${{$products['item']->price}}</h2>
                                            <p>{{$products['item']->title}}</p>
                                            <a href="{{route('product.addToCart',['id'=>$products['item']->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                            <a href="{{action('ProductController@show',[$products['item']->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
                                        </div>
                                    </div>
                            </div>
                            <div class="choose">
                                <ul class="nav nav-pills nav-justified">

                                    <li><a href="#"><i class="fa fa-plus-square"></i>remove from to wishlist</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
            @endforeach
         @else
         <h2>No, items in wishlist</h2>
         @endif   

    @endif
                              
</div><!--features_items-->
@endsection
