<div class="addProduct">
    <button id="sessionModal" type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal">
        Add new Product
	</button>
</div>
<div style="color: black" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <form action="{{url('/admin/addProduct')}}" method="post" enctype="multipart/form-data">
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add product</h4>
	      </div>
	      <div class="modal-body" style="color: black">
	        <div class="form-group {{ $errors->has('image') ? ' has-error' : '' }}">
				<label for="title">Image</label>
				<input  type="file" name="image">
				 @if ($errors->has('image'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('image') }}</strong>
	              </span>
	            @endif
			</div>
	        <div class="form-group {{ $errors->has('title') ? ' has-error' : '' }}">
				<label for="title">Title</label>
				<input class="form-control" type="text" name="title" >
				 @if ($errors->has('title'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('title') }}</strong>
	              </span>
	            @endif
			</div>
			<div class="form-group {{ $errors->has('description') ? ' has-error' : '' }}">
                <label>Description </label>
                
                <textarea class="form-control" type="text" name="description" > </textarea>
                @if ($errors->has('description'))
                  <span class="help-block">
                      <strong>{{ $errors->first('description') }}</strong>
                  </span>
                @endif
	        </div>

			<div class="form-group {{ $errors->has('price') ? ' has-error' : '' }}">
				<label>Price</label>
				<input class="form-control price-form" type="number" name="price" >
				 @if ($errors->has('price'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('price') }}</strong>
	              </span>
	            @endif
			</div>
			<div class="form-group ">
				<ul class="user_info">
					<li class="single_field {{ $errors->has('category_id') ? ' has-error' : '' }}">
						<label>Category:</label>
						<select name="category_id">
							<option>Select</option>
							@foreach($category as $c)
							<option value="{{$c->id}}">{{$c->category_name}}</option>
							@endforeach
						</select>
						 @if ($errors->has('category_id'))
			              <span class="help-block">
			                  <strong>{{ $errors->first('category_id') }}</strong>
			              </span>
			            @endif
					</li>
					<li class="single_field {{ $errors->has('brand_id') ? ' has-error' : '' }}">
						<label>Brand:</label>
						<select name="brand_id">
							<option>Select</option>
							@foreach($brand as $b)
							<option value="{{$b->id}}">{{$b->brand_name}}</option>
							@endforeach
							
						</select>
					 @if ($errors->has('brand_id'))
		              <span class="help-block">
		                  <strong>{{ $errors->first('brand_id') }}</strong>
		              </span>
		            @endif
					</li>
				</ul>
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