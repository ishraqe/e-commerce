<div class="product-details"><!--product-details-->
	<div class="col-sm-5">
		<div class="view-product">
			<img style="width: 360px; max-width: 358.45px; max-height: 300.433px " id="img_01" src="{{$productDetails[0]->image_header}}" data-zoom-image="{{$productDetails[0]->image_header}}"/>
			
			<div id="gal1">
				<ul class="list-inline">
					<li class="list-inline-item">
						<a href="#" data-image="{{$productDetails[0]->image_header}}" data-zoom-image="{{$productDetails[0]->image_header}}">
							<img style="max-height: 56px" id="img_01" src="{{$productDetails[0]->image_header}}" />
						</a>
					</li>
				  <li class="list-inline-item">
				  	<a href="#" data-image="{{$productDetails[0]->image_2}}" data-zoom-image="{{$productDetails[0]->image_2}}">
						<img style="max-height: 56px" id="img_01" src="{{$productDetails[0]->image_2}}" />
					</a>
				  </li>
				  <li class="list-inline-item">
				  	<a href="#" data-image="{{$productDetails[0]->image_3}}" data-zoom-image="{{$productDetails[0]->image_3}}">
						<img style="max-height: 56px" id="img_01" src="{{$productDetails[0]->image_3}}" />
					</a>
				  </li>	
				  <li class="list-inline-item" >
				  	<a href="#" data-image="{{$productDetails[0]->image_4}}" data-zoom-image="{{$productDetails[0]->image_4}}">
						<img  style="max-height: 56px" id="img_01" src="{{$productDetails[0]->image_4}}" />
					</a>
				  </li>
				</ul>	
			</div>
		</div>
	</div>
	<div class="col-sm-7">
		<div class="product-information"><!--/product-information-->
			<img src="/images/product-details/new.jpg" class="newarrival" alt="" />
			<h2>{{$productDetails[0]->title}}</h2>
			<p>Web ID: 1089772</p>
			<img src="/images/product-details/rating.png" alt="" />
			<span>
				<span>US ${{$productDetails[0]->price}}</span>
				<label>Quantity:</label>
				<form action="{{route('product.addToCart',['id'=>$productDetails[0]->id])}}">
					<input type="number" value="0" name="quantity" />
					<button  class="btn btn-fefault cart">
						<i class="fa fa-shopping-cart"></i>
						Add to cart
					</button>
				</form>
			</span>
			<p><b>Availability:</b> In Stock</p>
			<p><b>Condition:</b> New</p>
			<p><b>Brand:</b><a href="#">{{$productDetails[0]->brand_name}}</a></p>
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
				<p>{{$productDetails[0]->description}}</p>
			</div>
		</div>
		
		<div class="tab-pane fade" id="companyprofile" >
			<div class="col-sm-12">	
				<ul>
					<li><a href=""><i class="fa fa-user"></i>{{$productDetails[0]->brand_name}}</a></li>
					<li>From: </li>
					<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
				</ul>

				<p>
					<h2>Brand description: {{$productDetails[0]->brand_description}}</h2>
				</p>		
			</div>
			<h4>Products from <a href="#">{{$productDetails[0]->brand_name}}</a></h4>
			@foreach($relatedByBrand as $relatedBrand)	
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="/images/home/gallery1.jpg" alt="" />
							<h2>$56</h2>
							<p>Easy Polo Black Edition</p>
							<a href="{{route('product.addToCart',['id'=>$productDetails[0]->id])}}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
						</div>
					</div>
				</div>
			</div>
			@endforeach
		</div>
		
		<div class="tab-pane fade" id="tag" >
			<h4>Product  by tag: {{$productDetails[0]->category_name}}</h4>
			@foreach($relatedByCategory as $relCat)
			<div class="col-sm-3">
				<div class="product-image-wrapper">
					<div class="single-products">
						<div class="productinfo text-center">
							<img src="/images/home/gallery1.jpg" alt="" />
							<h2>${{$relCat->price}}</h2>
							<p>{{$relCat->title}}</p>
							<a href="{{route('product.addToCart',['id'=>$productDetails[0]->id])}}" type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</a>
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

				<form action="{{action('ReviewController@storeReview',[$productDetails[0]->id])}}" method="post">
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

