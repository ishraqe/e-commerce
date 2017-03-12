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
	        <div class="form-group">
				<label for="title">Username</label>
				<input  type="text" class="form-control" name="name">
			</div>
	        <div class="form-group">
				<label for="email">email</label>
				<input class="form-control" type="email" name="email" >
				
			</div>
			<div class="form-group">
                <label>password </label>
                
                <input type="password" class="form-control" type="password" name="password" />
	        </div>

			<div class="form-group">
				<label>Confirm password</label>
				<input class="form-control price-form" type="password" name="againPassword" >
			</div>
			<div class="form-group ">
				<label>Admin type:</label>
						
						 <div class="checkbox">
						  <label><input lass="form-control" type="checkbox" name="admin_type[]"  value="2">Product and order</label>
						</div>
						<div class="checkbox">
						  <label><input lass="form-control" type="checkbox" name="admin_type[]"  value="3">Review </label>
						</div>
						<div class="checkbox ">
						  <label><input lass="form-control" type="checkbox" name="admin_type[]"  value="3">Blog</label>
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