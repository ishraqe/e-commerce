
<h1>Product list</h1>
<table class="table table-hover">
  <thead>
    <tr class="text-center">
      <th>#</th>
      <th>Item</th>
      <th>Title</th>
      <th>Description</th> 
      <th>Price</th>
      <th>Category</th>
      <th>Brand</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
  	<?php $index=1; ?>
    @foreach($product as $p)
    <tr class="text-center">
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
        <td><h4>{{ucfirst($p->title)}}</h4></td>
        <td><p>{{ucfirst($p->description)}}</p></td>
    	  <td><p>${{ucfirst($p->price)}}</p></td>     
    	  <td><p>{{ucfirst($p->category->category_name)}}</p></td>     
    	  <td><p>{{ucfirst($p->brand->brand_name)	}}</p></td>     
    	  <td>
    	  	<a href="{{action('adminController@editProductInfo',[$p->id])}}">Edit</a>
    		 <a class="cart_quantity_delete" id="confirmationCheck" href=#><i class="fa fa-times"></i></a>
         
                  <h4 class="modal-title" id="myModalLabel">Are you sure  you want to delete this product??</h4>
                <div class="modal-body">
                  <a class="btn btn-success" href="{{action('adminController@deleteProduct',[$p->id])}}">Yes</a>
                  <button class="btn btn-danger" type="button" class="btn btn-default" data-dismiss="modal">Close</button>
               
                </div>
              </div>
            </div>
          </div>
    	  </td>           
    </tr>
  		@endforeach
	{{ $product->render() }}
  </tbody>
</table>
