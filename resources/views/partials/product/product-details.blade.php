<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<div class="view-product">
			<img id="img_01" src="{{$productDetails->image}}" data-zoom-image="{{$productDetails->image}}"/>
			<div id="gal1">
				<a href="#" data-image="{{$productDetails->image}}" data-zoom-image="{{$productDetails->image}}">
					<img id="img_01" src="{{$productDetails->image}}" />
				</a>
				<a href="#" data-image="{{$productDetails->image}}" data-zoom-image="{{$productDetails->image}}">
					<img id="img_01" src="{{$productDetails->image}}" />
				</a>
				<a href="#" data-image="{{$productDetails->image}}" data-zoom-image="{{$productDetails->image}}">
					<img id="img_01" src="{{$productDetails->image}}" />
				</a>
				<a href="#" data-image="http://www.ford.ie/cs/BlobServer?blobtable=MungoBlobs&blobcol=urldata&blobheader=image%2Fjpeg&blobwhere=1214505722090&blobkey=id" data-zoom-image="http://www.ford.ie/cs/BlobServer?blobtable=MungoBlobs&blobcol=urldata&blobheader=image%2Fjpeg&blobwhere=1214505722090&blobkey=id">
					<img id="img_01" src="http://www.ford.ie/cs/BlobServer?blobtable=MungoBlobs&blobcol=urldata&blobheader=image%2Fjpeg&blobwhere=1214505722090&blobkey=id" />
				</a>
			</div>
		</div>
		<div id="similar-product" class="carousel slide" data-ride="carousel">

			  {{--<!-- Wrapper for slides -->--}}
			    {{--<!-- <div class="carousel-inner">--}}
					{{--<div class="item active">--}}
					  {{--<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>--}}
					  {{--<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>--}}
					  {{--<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>--}}
					{{--</div>--}}
					{{--<div class="item">--}}
					  {{--<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>--}}
					  {{--<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>--}}
					  {{--<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>--}}
					{{--</div>--}}
					{{--<div class="item">--}}
					  {{--<a href=""><img src="images/product-details/similar1.jpg" alt=""></a>--}}
					  {{--<a href=""><img src="images/product-details/similar2.jpg" alt=""></a>--}}
					  {{--<a href=""><img src="images/product-details/similar3.jpg" alt=""></a>--}}
					{{--</div>--}}

				{{--</div> -->--}}

			  {{--<!-- Controls -->--}}
			  {{--<!-- <a class="left item-control" href="#similar-product" data-slide="prev">--}}
				{{--<i class="fa fa-angle-left"></i>--}}
			  {{--</a>--}}
			  {{--<a class="right item-control" href="#similar-product" data-slide="next">--}}
				{{--<i class="fa fa-angle-right"></i>--}}
			  {{--</a> -->--}}
		</div>

	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<img src="/images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{$productDetails->title}}</h2>
			<p>Web ID: 1089772</p>
			<img src="/images/product-details/rating.png" alt="" />
			<span>
				<span>US ${{$productDetails->price}}</span>
				<label>Quantity:</label>
				<form action="{{route('product.addToCart',['id'=>$productDetails->id])}}">
					<input type="number" value="0" name="quantity" />
					<button  class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Add to cart
					</button>
				</form>
			</span>
			<p><b>Availability:</b> In Stock</p>
			<p><b>Condition:</b> New</p>
			<p><b>Brand:</b><a href="#">{{$productDetails->brand->brand_name}}</a></p>
			<a href=""><img src="/images/product-details/share.png" class="share img-responsive"  alt="" /></a>
		</div><!--/product-information-->
	</div>
</div><!--/product-details-->

<div class="category-tab shop-details-tab"><!--category-tab-->
	<div class="col-sm-12">
		<ul class="nav nav-tabs">
			<li><a href="#details" data-toggle="tab">Details</a></li>
			<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
			<li><a href="#tag" data-toggle="tab">Tag</a></li>
			<li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{count($review)}})</a></li>
		</ul>
	</div>
	<div class="tab-content">
		<div class="tab-pane fade" id="details" >
			<div class="col-sm-12">
				<p>{{$productDetails->description}}</p>
			</div>
		</div>
		
		<div class="tab-pane fade" id="companyprofile" >
			<div class="col-sm-12">	
				<ul>
					<li><a href=""><i class="fa fa-user"></i>{{$productDetails->brand->brand_name}}</a></li>
					<li>From: </li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
				</ul>

				<p>
					<h2>Brand description: {{$productDetails->brand->brand_description}}</h2>
				</p>		
			</div>
			<h4>Products from <a href="#">{{$productDetails->brand->brand_name}}</a></h4>
			@foreach($relatedByBrand as $relatedBrand)	
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="/images/home/gallery1.jpg" alt="" />
							<h2>$56</h2>
							<p>Easy Polo Black Edition</p>
							<a href="{{route('product.addToCart',['id'=>$productDetails->id])}}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		
		<div class="tab-pane fade" id="tag" >
			<h4>Product  by tag: {{$productDetails->category->category_name}}</h4>
			@foreach($relatedByCategory as $relCat)
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="/images/home/gallery1.jpg" alt="" />
							<h2>${{$relCat->price}}</h2>
							<p>{{$relCat->title}}</p>
							<a href="{{route('product.addToCart',['id'=>$productDetails->id])}}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		
		<div class="tab-pane fade active in" id="reviews" >
			<div class="col-sm-12">
				@if(Session::has('added_confirmation'))
                    <div class="alert alert-success flash" id="#flash">{{Session::get('added_confirmation')}}</div>
                @elseif(Session::has('notFound_confirmation'))
                   <div class="alert alert-success flash" id="#flash">{{Session::get('notFound_confirmation')}}</div>
                @endif
				@foreach($review as $r)	
				<ul>
					<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
					<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
					<li><a href=""><b>Rating: </b> <img src="/images/product-details/rating.png" alt="" /></a></li>
				</ul>
				<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
				
				@endforeach
				<p><b>Write Your Review</b></p>

				<form action="{{action('ReviewController@storeReview',[$productDetails->id])}}" method="post">
					<input type="hidden" name="_token" value="{{csrf_token()}}">
					<span>
						<input type="text" class="{{ $errors->has('reviewer_name') ? ' has-error' : '' }}" name="reviewer_name" value="{{old('reviewer_name')}}" placeholder="Your Name"/>
						


						<input type="email"  class="{{ $errors->has('reviewer_email') ? ' has-error' : '' }}" name="reviewer_email" value="{{old('reviewer_email')}}" placeholder="Email Address"/>
						@if ($errors->has('reviewer_name'))
                          <span class="help-block alert alert-danger ">
                              <strong>{{ $errors->first('reviewer_name') }}</strong>
                          </span>
                        @endif 
						@if ($errors->has('reviewer_email'))
                          <span class="help-block alert alert-danger ">
                              <strong>{{ $errors->first('reviewer_email') }}</strong>
                          </span>
                        @endif
					</span>


					<textarea  class="{{ $errors->has('reviewer_description') ? ' has-error' : '' }}" name="reviewer_description" value="{{old('reviewer_description')}}" ></textarea>
					@if ($errors->has('reviewer_description'))
                      <span class="help-block alert alert-danger ">
                          <strong>{{ $errors->first('reviewer_description') }}</strong>
                      </span>
                    @endif
					<b>Rating:


						<div id="rateYo"></div>
					<button type="submit" class="btn btn-default pull-right">
						Submit
					</button>
					</form>

			</div>
		</div>
		
	</div>
</div><!--/category-tab-->

