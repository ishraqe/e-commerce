@extends('layouts.master')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					{{--@include('partials.left-sidebar')--}}
				</div>
				<div class="col-sm-9">
					<div class="blog-post-area">
						<h2 class="title text-center">Latest From our Blog</h2>

						<div class="single-blog-post">

							<h3>{{$blogDesc->title}}</h3>
							@if(Auth::user()->id === $blogDesc->user->id)
								 <button id="blog-edit" class="btn btn-primary pull-right">Edit (open modal)</button>
							@endif

							
							<div class="post-meta">
								<ul>
									<li><i class="fa fa-user"></i> {{$blogDesc->user->name}}</li>
									<li><i class="fa fa-clock-o"></i>{{$blogDesc->created_at}}</li>
									<li><i class="fa fa-calendar"></i> {{$blogDesc->created_at}}</li>
								</ul>
								<span>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star"></i>
									<i class="fa fa-star-half-o"></i>
								</span>
							</div>
							<p>{{$blogDesc->short_description}}</p>
							<a href="">
								<img src="{{$blogDesc->blog_header_image}}" alt="">
							</a>
							<p>{!! $blogDesc->blog_body !!}</p>
						</div>

					</div><!--/blog-post-area-->

					<div class="rating-area">
						<ul class="ratings">
							<li class="rate-this">Rate this item:</li>
							<li>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star color"></i>
								<i class="fa fa-star"></i>
								<i class="fa fa-star"></i>
							</li>
							<li class="color">(6 votes)</li>
						</ul>

					</div><!--/rating-area-->

					<div class="media commnets">
						<a class="pull-left" href="#">
							<img class="media-object" src="/images/blog/man-one.jpg" alt="">//users image
						</a>
						<div class="media-body">
							<h4 class="media-heading">{{$blogDesc->user->name}}</h4>
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
						</div>
					</div><!--Comments-->
					<div class="response-area">
						<h2>{{count($comment)}} RESPONSES</h2>
						<ul class="media-list">
						@foreach($comment as $c)
							<li class="media">	
								

								<div class="media-body">
									<ul class="sinlge-post-meta">
										<li><i class="fa fa-user"></i>Janis Gallagher</li>
										<li><i class="fa fa-clock-o"></i>{{$c->created_at}} 1:33 pm</li>
										<li><i class="fa fa-calendar"></i> {{$c->created_at}} DEC 5, 2013</li>
									</ul>
									<p>{{$c->comment_body}}</p>

								</div>
							</li>
						@endforeach	
						</ul>					
					</div><!--/Response-area-->
					<div class="replay-box">
						<div class="row">
							<div class="col-md-12">
								<h2>Share your thoughts:</h2>
								@if (count($errors) > 0)
								    <div class="alert alert-danger">
								        <ul>
								            @foreach ($errors->all() as $error)
								                <li>{{ $error }}</li>
								            @endforeach
								        </ul>
								    </div>
								@endif

								<form action="{{route('blog.addComment',['id'=>$blogDesc->id])}}" method="post">
								  <input type="hidden" name="_token" value="{{csrf_token()}}">	
								  <div class="form-group">
								    <textarea name="comment_body" class="form-control" cols="10" rows="11"></textarea>
								  </div>
								  <button class="btn btn-primary" type="submit">Add</button>
								</form>
							</div>
						</div>
					</div><!--/Repaly Box-->
				</div>	
			</div>
		</div>
	</section>
	
@endsection