@extends('layouts.master')
@section('title')
Brands
@endsection

@section('content')
 <div class="features_items"><!--features_items-->
	<h2 class="title text-center">Brands</h2>
	
	@foreach($brand as $b)
	<div class="col-sm-2">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<li class="list-group-item justify-content-between">
						{{$b->brand_name}}
						<span class="badge badge-default badge-pill">
						<?php 
								  $products= DB::table('products')->where('brand_id',$b->id)->count();
								  echo $products;
						 ?></span>
					</li>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div><!--features_items-->


@endsection