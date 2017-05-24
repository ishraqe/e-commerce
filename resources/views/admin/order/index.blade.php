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
									<th>Receipt id</th>
									<th>Order State</th>
									<th>Customer Name</th>
									<th>Customer Address</th>
									<th>Contact No</th>
									<th>Products id</th>
									<th>ordered At</th>
									<th>Total Price</th>
								</tr>
							</thead>
							<tbody>
							<?php $index=1; ?>
							@foreach($allOrder as $a)

								<tr>
									<td>{{$index++}}</td>
									<td>{{$a->receipt_no}}</td>
									@if($a->order_state==1)
										<td>Delivered</td>
									@elseif($a->order_state==0)
										<td>Pending</td>
									@endif
									<td>{{$a->order_by}}</td>
									<td>{{$a->placeOfOrder}}</td>
									<td>{{$a->contact_no}}</td>
									<?php
										$product= DB::table('products')
										->where('id',$a->product_id)
										->select('id','title','price')
										->get();
									?>
									<td>
										@foreach($product as $p)
											<button type="button" class="btn btn-primary">{{$p->id}}

												<span class="badge">Qty: {{$a->qty}}</span>
											</button>
										@endforeach

									</td>
									<td>{{$a->created_at}}</td>
									<?php
									$totalPrice=0;
									foreach($product as $p){
										$totalPrice = ($p->price + $totalPrice)*$a->qty;
									}
									?>

									<td>{{$totalPrice}}</td>
								</tr>
							@endforeach
							</tbody>
						</table>
					</div>
				</div>
            </div>
        </div>
	</div>
@endsection