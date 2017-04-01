<div class="category-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs ul-category">
            @foreach($category as $k=>$c)
                <li class="@if($k == 0) active @endif"><a class="eachToggleProduct" @if($k == 0) id="firstEachLoad" @endif data-id="{{$c['id']}}" href="#eachCat-{{$c['id']}}" data-toggle="tab">{{$c['category_name']}} </a></li>
            @endforeach
        </ul>
    </div>
    <div class="tab-content">
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
                    /*var title=title;
                    if(res.status==200){
                        var source   = $("#edit-form-modal").html();
                        var template = Handlebars.compile(source);
                        var context = {'info':res.info,'category':res.category,brand:res.brand};
                        var html    = template(context);
                        $('#edit-form-info').html(html);

                    }*/
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
                        /*var title=title;
                         if(res.status==200){
                         var source   = $("#edit-form-modal").html();
                         var template = Handlebars.compile(source);
                         var context = {'info':res.info,'category':res.category,brand:res.brand};
                         var html    = template(context);
                         $('#edit-form-info').html(html);

                         }*/
                    }
                });
            })

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
