@extends('layouts.master')
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-3">
					{{--@include('partials.left-sidebar')--}}
				</div>
				<div class="col-sm-9" id="trigger-area">
					<div class="blog-post-area" >
						<h2 class="title text-center">Latest From our Blog</h2>

						<div class="single-blog-post" >

							<h3 id="id" data-id="{{$blogDesc->id}}">{{$blogDesc->title}}</h3>
							@if(!Auth::guest())
								@if(Auth::user()->id === $blogDesc->user->id)
									 <button id="blog-edit" class="btn btn-primary pull-right">Edit (open modal)</button>
								@endif
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
					<div class="replay-box">
						<div class="row">
							<div class="col-md-12">
								<h2>Share your thoughts:</h2>
								<form id="addCommentForm" >
									<ul class="errorMsg">
									</ul>

								  <div class="form-group">
								    <textarea name="comment_body" class="form-control" cols="10" rows="11"></textarea>
								  </div>
								  <a class="btn btn-primary" onclick="addThoughts(this)" type="submit">Add</a>
								</form>
							</div>
						</div>
					</div><!--/Repaly Box-->
					<div class="response-area" id="response-comment">
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
					
				</div>	
			</div>
		</div>
	</section>
	<script id="comment-entry-template" type="text/handlebars">
	 	<div class="response-area">
			<h2>@{{response}} RESPONSES</h2>
			<ul class="media-list">
			 @{{#each comment.comments}}
				<li class="media">	
					<div class="media-body">
						<ul class="sinlge-post-meta">
							<li><i class="fa fa-user"></i>Janis Gallagher</li>
							<li><i class="fa fa-clock-o"></i>@{{this.created_at}} 1:33 pm</li>
							<li><i class="fa fa-calendar"></i> @{{this.created_at}} DEC 5, 2013</li>
						</ul>
						<p>@{{this.comment_body}}</p>

					</div>
				</li>
			 @{{/each}}
			</ul>					
		</div><!--/Response-area-->
	</script>

	<script>
        function addThoughts(trigger) {

			var  comment=[];
            var trigger = $(trigger),
                container = trigger.parents('#trigger-area'),
                id = container.find('#id').attr('data-id');

            container.find('.form-control').each(function () {
                var triggerThis = $(this),
                    name = triggerThis.attr('name'),
                    type = triggerThis.attr('type'),
                    value = triggerThis.val();
                if(type == 'radio'){
                    if(triggerThis.prop('checked')){
                        var eachPro = {
                            name: name,
                            value: value
                        };
                    }
                } else {
                    var eachPro = {
                        name: name,
                        value: value
                    };
                }
                if(typeof eachPro != 'undefined'){
                    comment.push(eachPro);
                }
            });

            param = {
                "_token": "{{  csrf_token() }}",
                id : id,
				comment:comment,
				data:$('#addCommentForm').serialize()
            };
            trigger.parents('form').find('.errorMsg').html('');
            $.ajax({
                url: "/add/comment",
                method: "post",
                data:param,
                dataType: "json",
                success: function (res) {

                    if(res.status == 500){
                        var error=res.error;
                        $.each(error,function (i,v) {
                            var html =  '<li>'+v+'</li>';
                            trigger.parents('#trigger-area').find('.errorMsg').prepend(html);

                        });


                    }else if(res.status==200){
                       
                        var source   = $("#comment-entry-template").html();
                        var template = Handlebars.compile(source);
                        var context = {comment:res.comments,response:res.number_of_response};
                        var html    = template(context);
                        $('#response-comment').replaceWith(html);


                    }

                }
            })


        }
	</script>
@endsection