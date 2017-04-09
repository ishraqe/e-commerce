@extends('layouts.admin')

@section('title')
	Users
@endsection

@section('content')
<div class="main-content">
	<div class="container-fluid">
	  <h3 class="page-title">Tables</h3>
	  @include('admin.partials.addAdmin')
	  <div class="row">
	    <div class="col-md-12">
	      <!-- BASIC TABLE -->
	      <div class="panel">
	        <div class="panel-heading">
	          <h3 class="panel-title btn btn-info">All admin <span class="badge">{{count($admin)}}</span></h3>
	        </div>
	        <div class="panel-body">
	          <table class="table col-md-12">
	              @if(count($admin)>0)
	            <thead>
	              <tr>
	                <th>#</th>
	                
	                <th>Username</th>
	                <th>Admin type</th>
	                <th>From</th>
	                <th>Delete</th>
	              </tr>
	            </thead>
	            <tbody>
	              @foreach($admin as $u)
	                <tr>
	                  <td>{{$index++}}</td>
	                  <td>{{$u->name}}</td>
	                  <?php 
	                  
	                  $type=unserialize(base64_decode($u->admin_type));  
	            
	                   ?>

	                  	<td>
	                  	 <?php
	                  	?>

	                  </td>
	                  <td><button>Delete</button></td>
	                </tr>
	                @endforeach
	            @else
	                <div class="alert alert-info alert-dismissible" role="alert">
	                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                  <i class="fa fa-info-circle"></i> No admin available
	                </div>

	            @endif  
	            </tbody>
	          </table>
	        </div>
	        <div class="panel-heading">
	        
	        </div>
	      </div>
	      <!-- END BASIC TABLE -->
	    </div>
	    
	  </div>
	</div>
</div>

@endsection
@section('script')
	@if(!$errors->adminadderror->isEmpty())
		<script>
	        $(function() {
	            $('#addAdmin').modal('show');
	        });

		</script>
	@endif
@endsection