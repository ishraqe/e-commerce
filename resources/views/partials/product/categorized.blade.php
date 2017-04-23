<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs ul-category">
            @foreach($category as $k=>$c)
                <li class="@if($k == 0) active @endif"><a class="eachToggleProduct" @if($k == 0) id="firstEachLoad" @endif data-id="{{$c['id']}}" href="#eachCat-{{$c['id']}}" data-toggle="tab">{{$c['category_name']}} </a></li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content" id="cat-product">
        @foreach($category as $k=>$c)
            <div class="tab-pane fade @if($k == 0) active in @endif" id="eachCat-{{$c['id']}}" >
                <p class="text-center">
                    <i class="fa fa-spin fa-spinner fa-3x"></i> <br>
                    <a>Loading Products</a>
                </p>
            </div>
        @endforeach
    </div>
</div><!--/category-tab-->
<hr>

<script id="cat-product-template" type="text/x-handlebars-template"> 
    @{{#each product.product}}
    <div class="tab-pane fade active in">
       <div class="col-sm-3">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="@{{ this.image}}" alt="" />
                        <h2>$@{{ this.price}}</h2>
                        <p>@{{ this.title}}</p>
                        <a  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
                        <a  class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>
                    </div>
                    <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>$@{{ this.price}}</h2>
                            <p>@{{ this.title}}</p>
                            {{--<a href="{{route('product.addToCart',['id'=>$p->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>--}}
                            {{--<a href="{{action('ProductController@show',[$p->id])}}" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View Details</a>--}}
                        </div>
                    </div>
                </div>
                <div class="choose" style="height: 42px;">
                    <ul class="nav nav-pills nav-justified" style="background-color: white">
                        <li><a><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @{{/each}}
</script>

<script id="cat-product-notFound-template" type="text/x-handlebars-template">
    <div class="tab-pane fade active in">
        <div class="col-sm-12">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <div class="alert alert-info">
                            <strong>Info!</strong> @{{ message }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</script>



@section('script')
    <script>
        $(function () {
            var defaultCatid = $('#firstEachLoad').attr('data-id');
            var param = {
                "_token": "{{ csrf_token() }}",
                id : defaultCatid
            };
            $.ajax({
                url: "/categorisedProduct",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) { 
                    if(res.status==200){
                        var source   = $("#cat-product-template").html();
                        var template = Handlebars.compile(source);
                        var context = {'product':res.product};
                        var html    = template(context);
                        $('#cat-product').html(html);
                    }else if(res.status=500){
                        var source   = $("#cat-product-notFound-template").html();
                        var template = Handlebars.compile(source);
                        var context = {'message':res.message};
                        var html    = template(context);
                        $('#cat-product').html(html);
                    }
                }
            });

            $('.eachToggleProduct').on('shown.bs.tab', function (e) {
                var defaultCatid = $(this).attr('data-id');
                var param = {
                    "_token": "{{ csrf_token() }}",
                    id : defaultCatid
                };
                $.ajax({
                    url: "/categorisedProduct",
                    method: "post",
                    data: param,
                    dataType: "json",
                    success: function (res) {
                        
                        if(res.status==200){
                            var source   = $("#cat-product-template").html();
                            var template = Handlebars.compile(source);
                            var context = {'product':res.product};
                            var html    = template(context);
                            $('#cat-product').html(html);

                        }else if(res.status==500){
                            var source   = $("#cat-product-notFound-template").html();
                            var template = Handlebars.compile(source);
                            var context = {'message':res.message};
                            var html    = template(context);
                            $('#cat-product').html(html);
                        }
                    }
                })
            });

        });
    </script>
@stop





{{--
<div class="col-sm-3">
    <div class="product-image-wrapper">
        <div class="single-products">
            <div class="productinfo text-center">
                <img src="images/home/gallery1.jpg" alt="" />
                <h2>$56</h2>
                <p>Easy Polo Black Edition</p>
                <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
            </div>

        </div>
    </div>
</div>--}}
