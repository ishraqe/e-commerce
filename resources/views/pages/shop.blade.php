@extends('layouts.master')  
@section('content')
 
           
                       
    <section id="advertisement">
        <div class="container">
            <img src="/images/shop/advertisement.jpg" alt="" />
        </div>
    </section>
    
    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                   @include('partials.left-sidebar')
                </div>
                
                <div class="col-sm-9 padding-right">
                    <div class="features_items"><!--features_items-->
                        <h2 class="title text-center">Features Items</h2>

                    
                        @foreach($product as $p)
                        <div class="col-sm-4">
                            <div class="product-image-wrapper">
                                <div class="single-products">
                                    <div class="productinfo text-center">
                                        <img src="images/shop/product12.jpg" alt="" />
                                        <h2>${{$p->price}}</h2>
                                        <p>{{$p->title}}</p>
                                        <a href="{{route('product.addToCart',['id'=>$p->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        <a href="{{action('ProductController@show',[$p->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
                                    </div>
                                    <div class="product-overlay">
                                        <div class="overlay-content">
                                            <h2>$56</h2>
                                            <p>Easy Polo Black Edition</p>
                                            <a href="{{route('product.addToCart',['id'=>$p->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="choose">
                                    <ul class="nav nav-pills nav-justified">
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                                        <li><a href=""><i class="fa fa-plus-square"></i>Add to compare</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        @endforeach
                        
                       
                    </div><!--features_items-->
                     {!! $product->render() !!}
                </div>
            </div>
        </div>
    </section>
    
    
@endsection