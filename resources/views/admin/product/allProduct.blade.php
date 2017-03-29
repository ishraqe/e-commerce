
<h1>Product list</h1>
<table class="table table-hover">
  <thead>
    <tr class="text-center">
      <th>#</th>
      <th>Item</th>
      <th>Title</th>
      <th>Description</th> 
      <th>Price</th>
      <th>Quantity</th>
      <th>Category</th>
      <th>Brand</th>
      <th>Featured</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $index=1; ?>
    @foreach($product as $p)
    <tr class="" id="eachProduct-{{$p->id}}">
      <th scope="row">{{$index++}}</th>
    	 <td>
            <a href="{{$p->image}}" data-lightbox="{{$p->image}}" data-title="{{$p->title}}" style=" width: 72px; height: 62px;">
              <img src="{{$p->image}}" style=" width: 72px; height: 62px;">
            </a>
        </td>
         <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                  <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                </div>
                <div class="modal-body">
                  <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>
        <td style="max-width: 129px"><h4 class="data-class" data-id="{{$p->id}}">{{ucfirst($p->title)}}</h4></td>

        <?php
        $pieces = explode(" ", $p->description);
        $first_part = implode(" ", array_splice($pieces, 0, 10));

        ?>
        <td style="max-width: 129px" id="description"><p><?= $first_part; ?></p></td>
        <td><p>${{ucfirst($p->price)}}</p></td>
        <td><p>{{ucfirst($p->number_of_products)}}</p></td>
        <td style="max-width: 129px"><p>{{ucfirst($p->category->category_name)}}</p></td>
        <td style="max-width: 129px"><p>{{ucfirst($p->brand->brand_name)	}}</p></td>
        <td><p><?php echo $foo= ($p->is_featured== true )?  "yes" : "no" ; ?></p></td>
    	  <td id="actionProduct">
    	  	<a  onclick="editProductInfo(this)" style="color: mediumseagreen"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
            <a onclick="deleteProduct(this)" style="color: red"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
              {{--//deleteProduct--}}


    	  </td>           
    </tr>
  		@endforeach
	{{ $product->render() }}
  </tbody>
</table>

<div class="modal fade" id="editModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit product</h4>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-sm-12 '>
                        <div class='well' id="edit-form-info">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="deleteProduct">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">Delete product</h4>
            </div>
            <div class="modal-body">
                <div class='row'>
                    <div class='col-sm-12 '>
                        <div class='well' id="edit-form-info">
                            hello
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script id="edit-form-modal" type="text/x-handlebars-template">

    <form   id="editProfductform" class="text-left">
        <ul class="errorMsg">
        </ul>
        <input id="id" data-id="@{{ info.id }}" type="hidden" name="_token" value="{{csrf_token()}}">
        <div class='row'>
            <div class='col-sm-12'>
                <div class='form-group'>
                    <label for='title'>Title</label>
                    <input type='text' name='title' value="@{{ info.title }}" class='form-control' />
                </div>
                <div class='form-group'>
                    <label for='price'>Price</label>
                    <input type='number' min="0" name='price' value="@{{ info.price }}" class='form-control' />
                </div>
                <div class='form-group'>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for='brand_id'>Brand</label>
                            <select name='brand_id' class='form-control'>
                                @{{#each brand.brand}}

                                <option value="@{{ this.id }}">@{{ this.brand_name }}</option>

                                @{{/each}}
                            </select>
                        </div>
                        <div class="col-sm-6">
                            <label for='category_id'>Category</label>
                            <select name='category_id' class='form-control'>
                                @{{#each category.category}}
                                <option value="@{{ this.id }}">@{{ this.category_name }}</option>

                                @{{/each}}
                            </select>
                        </div>
                    </div>
                </div>
                <div class='form-group'>
                    <div class="row">
                        <div class="col-sm-6">
                            <label for='number_of_products'>Number of products</label>
                            <input type="number" min="0" value="@{{ info.number_of_product }}" class="form-control" name="number_of_products">
                        </div>
                        <div class="col-sm-6">
                            <label for="image">Image</label>
                            <input type="file" name="image" id="imgInp" value="@{{ info.image }}" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <legend>Featured:</legend>
                    @{{#ifCustom info.is_featured 1 operator="=="}}
                    <label class="radio-inline">
                        <input type="radio" name="is_featured" value="1" checked>Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="is_featured" value="0" >No
                    </label>
                    @{{/ifCustom}}

                    @{{#ifCustom info.is_featured 0 operator="=="}}
                    <label class="radio-inline">
                        <input type="radio" name="is_featured" value="1" >Yes
                    </label>
                    <label class="radio-inline">
                        <input type="radio" name="is_featured" value="0" checked>No
                    </label>
                    @{{/ifCustom}}
                </div>
            </div>
        </div>
        <div class="row">
            <div class='col-sm-12'>
                <div class='form-group'>
                    <label for='message'>Description</label>
                    <textarea class='form-control' name='description' rows='10'>@{{ info.description }}</textarea>
                </div>

                <div class='text-right'>
                    <input type="hidden" name="id" value="@{{ info.id }}">
                    <a class='btn btn-primary' onclick="updateProductInfo(this)">Save</a>
                </div>
            </div>
        </div>
    </form>
</script>


<script id="eachProduct-template" type="text/x-handlebars-template">

    <tr class="text-center" id="eachProduct-@{{product.id}}">
        <th scope="row">1</th>
        <td>
            <a href="@{{image}}" data-lightbox="@{{image}}" data-title="@{{product.title}}" style=" width: 72px; height: 62px;">
                <img src="@{{image}}" style=" width: 72px; height: 62px;">
            </a>
        </td>
        <div class="modal fade" id="imagemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">Image preview</h4>
                    </div>
                    <div class="modal-body">
                        <img src="" id="imagepreview" style="width: 400px; height: 264px;" >
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <td><h4 class="data-class" data-id="@{{product.id}}">@{{product.title}}</h4></td>
        <td><p>@{{product.description}}</p></td>
        <td><p>@{{product.price}}</p></td>
        <td><p>@{{product.category_name}}</p></td>
        <td><p>@{{product.brand_name}}</p></td>
        <td>
            <a  onclick="editProductInfo(this)">Edit</a>

            <a class="cart_quantity_delete" id="confirmationCheck" href=#><i class="fa fa-times"></i></a>

            <h4 class="modal-title" id="myModalLabel">Are you sure  you want to delete this product??</h4>
            <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </td>
    </tr>
</script>


<script>
    function  editProductInfo(trigger) {

        var trigger=$(trigger);
        var container=trigger.parents("tr");
        var dataId = container.find(".data-class").attr("data-id");
        $('#editModal').modal('show');
        param = {
            "_token": "{{ csrf_token() }}",
            id : dataId
        };

        $.ajax({
            url: "/admin/product/update/info",
            method: "post",
            data: param,
            dataType: "json",
            success: function (res) {
                var title=title;
                if(res.status==200){
                    var source   = $("#edit-form-modal").html();
                    var template = Handlebars.compile(source);
                    var context = {'info':res.info,'category':res.category,brand:res.brand};
                    var html    = template(context);
                    $('#edit-form-info').html(html);

                }
            }
        })
    }

    function updateProductInfo(trigger) {
        var product = [];
        var trigger = $(trigger),
            container = trigger.parents('#editProfductform'),
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
                product.push(eachPro);
            }
        });
        param = {
            "_token": "{{ csrf_token() }}",
            id : id,
            product:product
        };


        trigger.parents('form').find('.errorMsg').html('');
        $.ajax({
            url: "/admin/product/saveUpdate",
            method: "post",
            data: $('#editProfductform').serialize(),
            dataType: "json",
            success: function (res) {

                if(res.status == 500){
                    var error=res.error;
                    $.each(error,function (i,v) {
                        var html =  '<li>'+v+'</li>';
                        trigger.parents('form').find('.errorMsg').prepend(html);

                    });
                }else if(res.status==200){
                    var source   = $("#eachProduct-template").html();
                    var template = Handlebars.compile(source);
                    var context = {product:res.product};
                    var html    = template(context);
                    $('#editModal').modal('hide');
                    $('#eachProduct-'+res.product.id).replaceWith(html);


                }

            }
        })


    }


    function  deleteProduct(trigger) {

        var trigger=$(trigger);
        var container=trigger.parents("tr");
        var dataId = container.find(".data-class").attr("data-id");
        $('#deleteProduct').modal('show');
        param = {
            "_token": "{{ csrf_token() }}",
            id : dataId
        };

        $.ajax({
            url: "/admin/product/delete",
            method: "post",
            data: param,
            dataType: "json",
            success: function (res) {
                if(res.status==200){

                    $(document).ajaxStop(function(){
                        window.location.reload();
                    });

                }
            }
        })
    }
</script>