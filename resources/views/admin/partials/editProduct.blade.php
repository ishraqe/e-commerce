<div class="form-container">
    <h1>Edit info:</h1>
    <form action="#" method="post" id="edit-form-info">

    </form>

</div>
<script id="edit-form-modal" type="text/x-handlebars-template">
    <input type="hidden" name="_token" value="{{csrf_token()}}">
    <div class="form-group">
        <label > Title</label>
        <input id="productTitle" class="form-control" type="text" name="title" value="@{{ info.title }} ">

    </div>
    <div class="form-group ">
        <label>Description </label>

        <textarea class="form-control" type="text" name="description" ></textarea>

    </div>

    <div class="form-group ">
        <label>Price</label>
        <input class="form-control price-form" type="number" name="price" value="">

    </div>
    <div class="form-group ">
        <ul class="user_info">
            <li class="single_field ">
                <label>Category:</label>
                <select name="category_id">
                    <option>Select</option>
                   @{{#each category.category}}
                    <option>@{{ this.category_name }}</option>

                    @{{/each}}
                </select>

            </li>
            <li class="single_field">
                <label>Brand:</label>
                <select name="brand_id">
                    <option>Select</option>


                </select>

            </li>
        </ul>
    </div>
    <div class="form-group">
        <div class="row">
            <div class="col-md-6">
                <label>Old image: </label>
                <img class="pro-image" src="">
            </div>
            <div class="col-md-6">
                <label>New Image</label>
                <input  type="file" name="image">

            </div>
        </div>
    </div>
    <div class="form-group">

        <input class="btn btn-primary" type="Submit" name="submit" value="Update">
    </div>
</script>