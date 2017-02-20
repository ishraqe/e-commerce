@extends('layouts.master')
@section('title')
	{{Auth::user()->name}}'s
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
						<button>Hello</button>
						<h2 class="title text-center">Latest From my Blog</h2>
						@foreach($myblog as $b)
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
							
							<p>{{implode(' ', array_slice(str_word_count($b->blog_body, 2), 0, 42))}}</p>
							<a  class="btn btn-primary" href="{{action('blogController@showBlog',[$b->id])}}">Read More</a>
						</div>

						@endforeach


					</div>
					{!! $myblog->render() !!}
				</div>
			</div>
		</div>
	</section>
@endsection