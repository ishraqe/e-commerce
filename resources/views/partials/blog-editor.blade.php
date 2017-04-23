<div class="modal fade" id="myBlogmodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add your blog content here:  (ajax form validation)</h4>
      </div>
      <div class="modal-body">
      
        <form action="{{route('create.blog')}}" method="post" enctype="multipart/form-data" >
        <div class="form-group {{ $errors->blogErrors->first('blogTitle') ? ' has-error' : '' }}">
				<label for="blog-title">Blog title</label>
				<input type="text" class="form-control" id="blog-title"  name ="blogTitle" placeholder="Enter title here">

				 @if ($errors->blogErrors->first('blogTitle') )
	              <span class="help-block">
	                    <strong>{{ $errors->blogErrors->first('blogTitle') }}</strong>
	              </span>
	       @endif
			</div>
      <div class="form-group {{ $errors->blogErrors->first('short_description') ? ' has-error' : '' }}">
        <label for="short_description">Short description</label>
        <input type="text" class="form-control" id="short_description"  name ="short_description" placeholder="Enter description here">

         @if ($errors->blogErrors->first('short_description') )
                <span class="help-block">
                      <strong>{{ $errors->blogErrors->first('short_description') }}</strong>
                </span>
         @endif
      </div>
			
			<div class="form-group {{ $errors->blogErrors->first('blog_header_image') ? ' has-error' : '' }}">
				<label for="blog_header_image">Blog header image</label>
				<input type="file" class="form-control" name="blog_header_image" id="blog_header_image">
				@if ($errors->blogErrors->first('blog_header_image'))
	              <span class="help-block">
	                    <strong>{{ $errors->blogErrors->first('blog_header_image') }}</strong>
	              </span>
	            @endif
			</div>

            <div class="form-group {{ $errors->blogErrors->first('blogBody') ? ' has-error' : '' }}">
                <label for="input">Blogs description</label>
                <textarea class="form-control" name="blogBody" id="blog-body" rows="10"></textarea>
                @if ($errors->blogErrors->first('blogBody'))
	              <span class="help-block">
	                    <strong>{{ $errors->blogErrors->first('blogBody') }}</strong>
	              </span>
	            @endif
            </div>
            {{ csrf_field() }}
            <button  class="btn btn-primary" type="submit">Submit</button>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>