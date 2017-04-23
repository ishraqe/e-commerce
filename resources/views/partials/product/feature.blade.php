<div class="features_items"><!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    
@foreach($featured as $p)
    <div class="col-sm-3">
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
    
</div><!--features_items-->
