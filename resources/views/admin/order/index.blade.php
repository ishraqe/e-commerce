@extends('layouts.admin')

@section('title')
    Order's
@endsection


@section('content')

    <div class="main-content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Order List</h3><br>
						<p class="lead">Filter By:</p>
			            <div id="tab" class="btn-group" data-toggle="buttons-radio">
			              <a href="#prices2" class="btn btn-large btn-info active" data-toggle="tab">Latest</a>
			              <a href="#features2" class="btn btn-large btn-info" data-toggle="tab">Old</a>
			              <a href="#requests2" class="btn btn-large btn-info" data-toggle="tab">Delivedred</a>
			              <a href="#contact2" class="btn btn-large btn-info"  data-toggle="tab">Pending</a>
			            </div> 
						<div class="right">
							<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>First Name</th>
												<th>Last Name</th>
												<th>Username</th>
											</tr>
										</thead>
										<tbody>
										@foreach($allOrder as $a)
											<?php dd($a['id']); ?>
											{{--<tr>--}}
												{{--<td>1</td>--}}
												{{--<td>Steve</td>--}}
												{{--<td>Jobs</td>--}}
												{{--<td>@steve</td>--}}
											{{--</tr>--}}
											{{--<tr>--}}
												{{--<td>2</td>--}}
												{{--<td>Simon</td>--}}
												{{--<td>Philips</td>--}}
												{{--<td>@simon</td>--}}
											{{--</tr>--}}
											{{--<tr>--}}
												{{--<td>3</td>--}}
												{{--<td>Jane</td>--}}
												{{--<td>Doe</td>--}}
												{{--<td>@jane</td>--}}
											{{--</tr>--}}
										@endforeach
										</tbody>
									</table>
					</div>
				</div>
                <!-- END TODO LIST -->
            </div>
        </div>
       <!--  <div class="row">
            <div class="col-md-12">
                <div class="panel">
					<div class="panel-heading">
						<h3 class="panel-title">Panel Default</h3>
						<div class="right">
							<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
							<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
						</div>
					</div>
					<div class="panel-body">
						<table class="table table-striped">
										<thead>
											<tr>
												<th>#</th>
												<th>Order ID</th>
												<th>Receipt ID</th>
												<th>Order By</th>
												<th>Ordered At</th>
												<th>Numper Of products</th>
												<th>Price</th>
												<th>Status</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>1</td>
												<td>Steve</td>
												<td>Jobs</td>
												<td>@steve</td>
											</tr>
											<tr>
												<td>2</td>
												<td>Simon</td>
												<td>Philips</td>
												<td>@simon</td>
											</tr>
											<tr>
												<td>3</td>
												<td>Jane</td>
												<td>Doe</td>
												<td>@jane</td>
											</tr>
										</tbody>
									</table>
					</div>
				</div>
                <!-- END TODO LIST -->
            </div>
        </div> -->
        <!-- END TODO LIST -->
    </div>
@endsection