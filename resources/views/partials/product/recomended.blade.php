<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">recommended items</h2>
    <div class="owl-carousel owl-theme">
        @foreach($recommended as $r)
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{$r->image}}" alt="" />
                        <h2>${{$r->price}}</h2>
                        <p>{{$r->title}}</p>
                        <a href="{{route('product.addToCart',['id'=>$r->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        <a href="{{action('ProductController@show',[$r->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>${{$r->price}}</h2>
                            <p>{{$r->title}}</p>
                            <a href="{{route('product.addToCart',['id'=>$r->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                            <a href="{{action('ProductController@show',[$r->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
                        </div>
                    </div>
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a ><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    </ul>
                </div>
            </div>
        @endforeach
    </div>
</div><!--/recommended_items-->
