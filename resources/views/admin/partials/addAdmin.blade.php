<div class="addProduct">

    <button id="sessionModal" type="button" class="btn btn-info btn-sm"  style =" margin-bottom: 10px; font-size: 18px;
color: grey;" data-toggle="modal" data-target="#addAdmin">
        Add new admin
	</button>
</div>
<div style="color: black" class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <form action="{{url('/admin/addProduct')}}" method="post" enctype="multipart/form-data">
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add admin</h4>
	      </div>
	      <div class="modal-body" style="color: black">
	        <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
				<label for="title">Username</label>
				<input  type="text" name="name">
				 @if ($errors->has('name'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('name') }}</strong>
	              </span>
	            @endif
			</div>
	        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
				<label for="email">email</label>
				<input class="form-control" type="email" name="email" >
				 @if ($errors->has('email'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('email') }}</strong>
	              </span>
	            @endif
			</div>
			<div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label>password </label>
                
                <textarea class="form-control" type="password" name="password" > </textarea>
                @if ($errors->has('password'))
                  <span class="help-block">
                      <strong>{{ $errors->first('password') }}</strong>
                  </span>
                @endif
	        </div>

			<div class="form-group {{ $errors->has('againPassword') ? ' has-error' : '' }}">
				<label>Confirm password</label>
				<input class="form-control price-form" type="password" name="againPassword" >
				 @if ($errors->has('againPassword'))
	              <span class="help-block">
	                  <strong>{{ $errors->first('againPassword') }}</strong>
	              </span>
	            @endif
			</div>
			<div class="form-group ">
				<ul class="user_info">
					<li class="single_field {{ $errors->has('category_id') ? ' has-error' : '' }}">
						<label>Admin type:</label>
						
					</li>
					<li class="single_field {{ $errors->has('brand_id') ? ' has-error' : '' }}">
						<label>Brand:</label>
						
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