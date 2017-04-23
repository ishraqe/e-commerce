<div class="addProduct">

    <button id="sessionModal" type="button" class="btn btn-info btn-sm"  style =" margin-bottom: 10px; font-size: 18px;
color: grey;" data-toggle="modal" data-target="#addAdmin">
        Add new admin
	</button>
</div>
<div style="color: black" class="modal fade" id="addAdmin" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
	<div class="modal-dialog" role="document">
	  <div class="modal-content">
	    <form action="{{route('admin.addAdmin')}}" method="post" >
	    <input type="hidden" name="_token" value="{{csrf_token()}}">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add admin</h4>
	      </div>
	      <div class="modal-body" style="color: black">
      		@if (!$errors->adminadderror->isEmpty())
	            <div class="form_error_login">
	                <strong>Whoops!</strong> There were some problems with your input.<br><br>
	                    <ul>
	                        @foreach ($errors->adminadderror->all() as $error)
	                            <li class="alert alert-danger signInError">{{ $error }}</li>
	                        @endforeach
	                    </ul>
	            </div>
	        @endif
	        <div class="form-group">
				<label for="title">Username</label>
				<input  type="text" class="form-control" name="name" value="{{old('name')}}">
			</div>
	        <div class="form-group">
				<label for="email">email</label>
				<input class="form-control" type="email" name="email" value="{{old('email')}}" >
				
			</div>
			<div class="form-group">
				<label for="password">Password</label>
                <input class="form-control" type="password" id="registerPassword" name="password" placeholder="Password"/>
					
	        </div>
	        <div class="form-group">
				<label for="confirm_password">Confirm password</label>
				<small id="ConfirmPasswordMessage" ></small>
				<input class="form-control" type="password" id="registerConfirmPassword" name="confirm_password" placeholder="Confirm Password"/>		
	        </div>

			<div class="form-group ">
				<label>Admin type:</label>
						
				 <div class="checkbox">
				  <label><input class="form-control" type="checkbox" name="admin_type[]"  value="2">Product and order</label>
				</div>
				<div class="checkbox">
				  <label><input class="form-control" type="checkbox" name="admin_type[]"  value="3">Review </label>
				</div>
				<div class="checkbox ">
				  <label><input class="form-control" type="checkbox" name="admin_type[]"  value="3">Blog</label>
				</div>	
			</div>         
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Add admin</button>
	      </div>
	    </form>   
	  </div>
	</div>
</div>