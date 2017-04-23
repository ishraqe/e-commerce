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
					<a href="{{route('categories.products',['id'=>$c->id])}}">
						<li class="list-group-item justify-content-between">
							{{$c->category_name}}
                            <?php
                            $products= DB::table('products')->where('category_id',$c->id)->count();
                            ?>
							<span class="badge badge-default badge-pill">{{$products}}</span>
						</li>
					</a>
				</div>
			</div>
		</div>
	</div>
	@endforeach
</div><!--features_items-->


@endsection