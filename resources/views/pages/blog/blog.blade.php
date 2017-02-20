@extends('layouts.master')
@section('title')
	Blog
@endsection
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					@include('partials.left-sidebar')
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>
						@foreach($blog as $b)
						<div class="single-blog-post">
							<h3>{{$b->title}}</h3>
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> {{ $b->user->name }}</li>
									<li><i class="fa fa-clock-o"></i>{{$b->created_at}}</li>
									<li><i class="fa fa-calendar"></i>{{$b->created_at}}</li>
								</ul>
								<span>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star"></i>
										<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<a href="">
								<img src="{{$b->blog_header_image}}" alt="">
							</a>
							<p>{{implode(' ', array_slice(str_word_count($b->blog_body, 2), 0, 42))}}</p>
							<a  class="btn btn-primary" href="{{action('blogController@showBlog',[$b->id])}}">Read More</a>
						</div>

						@endforeach
						{!! $blog->links() !!}
					</div>
				</div>
			</div>
		</div>
	</section>
@endsection