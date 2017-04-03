<div class="addProduct">
    <button id="sessionModal" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#addProduct">
        Add new Product
	</button>
</div>
<div style="color: black" class="modal fade" id="addProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
		  <?php
		  	$url='/admin/addProduct';
		  ?>
	    <form action="{{url($url)}}" method="post" enctype="multipart/form-data">
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add product</h4>
	      </div>
	      <div class="modal-body" style="color: black">
	      <div class="row">
	      	<div class="col-md-6">
	      		
					<label for="title">Image</label>
					<input class="form-control" type="file" name="image" id="imgInp">
	      	</div>
	      	<div class="col-md-6 image-product-container">
	      		<div class="form-group image-product" style="margin-top: 24px; max-height: 119px;
max-width: 51px;">
	      			<img id="blah" class="img-responsive imagePreview" src="#" style="height: inherit;
width: 100%;" alt="product image" />
	      		</div>
	      		
	      	</div>
	      </div>
	        
	        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title">Title</label>
				<input class="form-control" type="text" name="title" >
				 
			</div>
			<div class="form-group ">
                <label>Description </label>
                
                <textarea class="form-control" type="text" name="description" > </textarea>
               
	        </div>
	        <div class="row">
	        	<div class="col-md-6">
	        		<div class="form-group ">
						<label>Price</label>
						<input class="form-control price-form" min="1" type="number" name="price" >
					</div>
	        	</div>
	        	<div class="col-md-6">
	        		<div class="form-group">
						<label>Number of products:</label>
						<input type="number" name="number_of_products" min="1" class="form-control ">
						
					</div>
	        	</div>
	        </div>
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label>Category:</label>
						<select name="category_id" class=" form-control">
							<option>Select</option>
							@foreach($category as $c)
							<option value="{{$c->id}}">{{$c->category_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label>Brand:</label>
						<select name="brand_id" class="form-control ">
							<option>Select</option>
							@foreach($brand as $b)
							<option value="{{$b->id}}">{{$b->brand_name}}</option>
							@endforeach
						</select>
					</div>
				</div>
			</div>
			<div class="row">

				<div class="col-md-12">
					<div class="form-group">
						<legend>Featured:</legend>
						<label class="radio-inline">
							<input type="radio" name="is_featured" value="1">Yes
						</label>
						<label class="radio-inline">
							<input type="radio" name="is_featured" value="0" checked>No
						</label>
					</div>
				</div>
			</div>
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add Product</button>
	      </div>
	    </form>   
	  </div>
	</div>
</div>
@section('script')
	@if(!$errors->addProductError->isEmpty())
		<script>
	        $(function() {
	            $('#addProduct').modal('show');
	        });
	        
		</script>
	@endif
@endsection