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
						<!-- Button trigger modal -->
						<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myBlogmodal">
						  Add new blog
						</button>
						<!-- Modal -->
						@include('partials.blog-editor')
						<h2 class="title text-center">Latest From my Blog</h2>
						@include('partials.message')
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
							<div class="centeredImageContainer">
								@if(!empty($b->blog_header_image))
									<img class="centeredImage" src="{{$b->blog_header_image}}" alt="">
								@endif
							</div>
							 <p>{{implode(' ', array_slice(str_word_count($b->short_description, 2), 0, 42))}}</p>
							<a  class="btn btn-primary" href="{{action('blogController@showBlog',[$b->id])}}">Read More</a>
						</div>

						@endforeach


					</div>
					<div class="blog-page">
						{!! $myblog->render() !!}
					</div>
					
				</div>
			</div>
		</div>
	</section>
@endsection

@if(!empty($errors->blogErrors->all()))
@section('script')

<script type="text/javascript">
    $(window).load(function(){
        $('#myBlogmodal').modal('show');
    });
</script>
@endsection
@endif
