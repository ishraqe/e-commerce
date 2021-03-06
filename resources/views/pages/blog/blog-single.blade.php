@extends('layouts.master')
@section('title')
	<?php
    $result = substr($blogDesc->title, 0,5);
	echo  "Blog-".$result;
	?>
@endsection
@section('content')
	<section>
		<div class="container">
			<div class="row">
				<div class="col-sm-12" id="trigger-area">
					<div class="blog-post-area" >
						<h2 class="title text-center">Latest From our Blog</h2>

						<div class="single-blog-post" id="blog-data" >

							<h3 id="id" data-id="{{$blogDesc->id}}">{{$blogDesc->title}}</h3>
							@if(!Auth::guest())
								@if(Auth::user()->id === $blogDesc->user->id)
									<a onclick="editBlogInfo(this)" type="button" id="blog-edit" class="btn btn-primary pull-right" data-toggle="modal" >
										Edit
									</a>
									<div class="modal fade" id="myEditBlogmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
										<div class="modal-dialog" role="document">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
													<h4 class="modal-title" id="myModalLabel">Add your blog content here:  (ajax form validation)</h4>
												</div>
												<div class="modal-body" id="edit-blog-info">

													@include('partials.edit-blog')
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
												</div>
											</div>
										</div>
									</div>

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
							<div class="centeredImageContainer">
								<img class="centeredImage" src="{{$blogDesc->blog_header_image}}" alt="">
							</div>
							<hr>
							<div class="centeredImageContainer">
								<h2>Description</h2>
								<p class="centeredImage">{!! $blogDesc->blog_body !!}</p>
							</div>

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
								@if(!Auth::guest())
								  <a class="btn btn-primary" onclick="addThoughts(this)" type="submit">Add</a>
									@else
										<a class="btn btn-primary" href="{{url('/login')}}"  type="submit">Add</a>
									@endif
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
			<h2> @{{response}} RESPONSES </h2>
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
		function renderEditor(){
            var editor_config = {
                path_absolute : "{{ URL::to('/') }}/",
                selector: "#blog-body",
                plugins: [
                    "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                    "searchreplace wordcount visualblocks visualchars  fullscreen",
                    "insertdatetime media nonbreaking save table contextmenu directionality",
                    "emoticons template paste textcolor colorpicker textpattern"
                ],
                toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media",
                relative_urls: false,
                file_browser_callback : function(field_name, url, type, win) {
                    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;
                    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
                    if (type == 'image') {
                        cmsURL = cmsURL + "&type=Images";
                    } else {
                        cmsURL = cmsURL + "&type=Files";
                    }
                    tinyMCE.activeEditor.windowManager.open({
                        file : cmsURL,
                        title : 'Filemanager',
                        width : x * 0.8,
                        height : y * 0.8,
                        resizable : "yes",
                        close_previous : "no"
                    });
                }
            };
            tinymce.init(editor_config);
		}
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

	<script>
		function editBlogInfo(trigger) {

            var  comment=[];
            var trigger = $(trigger),
                container = trigger.parents('#trigger-area'),
                id = container.find('#id').attr('data-id');

            $('#myEditBlogmodal').modal('show');

            param = {
                "_token": "{{ csrf_token() }}",
                id : id
            };

            $.ajax({
                url: "/user/blog/update/info",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status==200){

                        var source   = $("#edit-form-modal").html();
                        var template = Handlebars.compile(source);
                        var context = {'info':res.info};
                        var html    = template(context);
                        $('#edit-blog-info').html(html);
                        renderEditor();

                    }
                }
            })
        }
	</script>
@endsection