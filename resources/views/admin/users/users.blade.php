@extends('layouts.admin')

@section('title')
	Users
@endsection

@section('content')
<div class="main-content">
	<div class="container-fluid">
	  <h3 class="page-title">Tables</h3>
	  <div class="row">
	    <div class="col-md-12">
	      <!-- BASIC TABLE -->
	      <div class="panel">
	        <div class="panel-heading">
	          <h3 class="panel-title btn btn-info">All users <span class="badge">{{count($users)}}</span></h3>
	        </div>
	        <div class="panel-body">
	          <table class="table">
	              @if(count($users)>0)
	            <thead>
	              <tr>
	                <th>#</th>
	                <th>First Name</th>
	                <th>Last Name</th>
	                <th>Username</th>
	                <th>Delete</th>
	              </tr>
	            </thead>
	            <tbody>
	              @foreach($users as $u)
	                <tr>
	                  <td>1</td>
	                  <td>Steve</td>
	                  <td>Jobs</td>
	                  <td>@steve</td>
	                  <td><button>Delete</button></td>
	                </tr>
	                @endforeach
	            @else
	                <div class="alert alert-info alert-dismissible" role="alert">
	                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	                  <i class="fa fa-info-circle"></i> No user available
	                </div>

	            @endif  
	            </tbody>
	          </table>
	        </div>
	        <div class="panel-heading">
	         {{ $users->render() }}
	        </div>
	      </div>
	      <!-- END BASIC TABLE -->
	    </div>
	    
	  </div>
	</div>
</div>

@endsection

