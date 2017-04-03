
<script id="edit-form-modal" type="text/x-handlebars-template">
    <form >
        <div class="form-group">
            <label for="blog-title">Blog title</label>
            <input type="text" class="form-control" id="blog-title"  value="@{{ info.title }}" name ="blogTitle" placeholder="Enter title here">

        </div>
        <div class="form-group">
            <label for="short_description">Short description</label>
            <input type="text" class="form-control" id="short_description"  value="@{{ info.short_description }}" name ="short_description" placeholder="Enter description here">
        </div>

        <div class="form-group">
            <label for="blog_header_image">Blog header image</label>
            <input type="file" class="form-control" name="blog_header_image" id="blog_header_image">

        </div>

        <div class="form-group">
            <label for="input">Blogs description</label>
            <textarea class="form-control" name="blogBody" id="blog-body" rows="10">@{{ info.blog_body }}</textarea>
        </div>
        <input id="id" data-id="@{{ info.id }}" type="hidden" name="_token" value="{{csrf_token()}}">
        <button  class="btn btn-primary" type="submit">Submit</button>

    </form>
</script>




