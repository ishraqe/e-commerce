@extends('layouts.master')
@section('title')
Categories
@endsection

@section('content')
 <div class="features_items"><!--features_items-->
	<h2 class="title text-center">Categories</h2>
	@foreach($category as $c)
	<div class="col-sm-2">
		<div class="product-image-wrapper">
			<div class="single-products">
				<div class="productinfo text-center">
					<li class="list-group-item justify-content-between">
						{{$c->category_name}}
						<span class="badge badge-default badge-pill">14</span>
					</li>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div><!--features_items-->


@endsection