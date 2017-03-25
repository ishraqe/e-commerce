
<script id="edit-form-modal" type="text/x-handlebars-template">
    <form >
        <div class="form-group {{ $errors->blogErrors->first('blogTitle') ? ' has-error' : '' }}">
            <label for="blog-title">Blog title</label>
            <input type="text" class="form-control" id="blog-title"  value="@{{ info.title }}" name ="blogTitle" placeholder="Enter title here">

            @if ($errors->blogErrors->first('blogTitle') )
                <span class="help-block">
	                    <strong>{{ $errors->blogErrors->first('blogTitle') }}</strong>
	              </span>
            @endif
        </div>
        <div class="form-group {{ $errors->blogErrors->first('short_description') ? ' has-error' : '' }}">
            <label for="short_description">Short description</label>
            <input type="text" class="form-control" id="short_description"  value="@{{ info.short_description }}" name ="short_description" placeholder="Enter description here">

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
            <textarea class="form-control" name="blogBody" id="blog-body" rows="10">@{{ info.blog_body }}</textarea>
            @if ($errors->blogErrors->first('blogBody'))
                <span class="help-block">
	                    <strong>{{ $errors->blogErrors->first('blogBody') }}</strong>
	              </span>
            @endif
        </div>
        <input id="id" data-id="@{{ info.id }}" type="hidden" name="_token" value="{{csrf_token()}}">
        <button  class="btn btn-primary" type="submit">Submit</button>

    </form>
</script>




