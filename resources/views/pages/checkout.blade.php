@extends('layouts.master')
@section('title')
	Checkout
@endsection

@section('content')
<section id="cart_items">
	<div class="container">
		<div class="breadcrumbs">
			<ol class="breadcrumb">
			  <li><a href="#">Home</a></li>
			  <li class="active">Check out</li>
			</ol>
		</div><!--/breadcrums-->
		@if(Cart::count() !=0)
		<div class="register-req">
			<p> Returning customer ? <small>Click here to <a href="#">login</a></small></p>
		</div><!--/register-req-->

		<div class="shopper-informations">
			<div class="row">
				<div class="col-sm-12 clearfix">
					<div class="bill-to">
						<p>Bill To</p>
						<div class="form-one">
							
								<input type="text" placeholder="Name">
								<input type="text" placeholder="Address">
								<input type="text" placeholder="Contact No">
							
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="review-payment">
			<h2>Review & Payment <small>(Cash on dalibery)</small></h2>
		</div>
		
		<div class="table-responsive cart_info">
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Item</td>
						<td class="description">Title</td>
						<td class="price">Price</td>
						<td class="quantity">Quantity</td>
						<td class="total">Total</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach(Cart::content() as $row)
                        <tr>
                            <td class="cart_product">
                                <a href="#"><img height="120px"   src="{{$row->options->image}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <p>{{$row->name}}</p>

                            </td>
                            <td class="cart_price">
                                <p>$ <span class="value">{{$row->price}}</span></p>
                            </td>
                            <td class="cart_quantity">
                                <p>{{$row->qty}}</p>
                            </td>
                            <td class="cart_total">
                                <p id="totalPriceOf" class="cart_total_price">${{$row->qty*$row->price}}</p>
                            </td>
                            <td class="cart_delete">
                                <a  href="{{route('cart.deleteItem',['rowId'=>$row->rowId])}}" class="cart_quantity_delete" onclick="removeItem(this)"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
					<tr>
						<td colspan="4">&nbsp;</td>
						<td colspan="2">
							<table class="table table-condensed total-result">
								<tr>
									<td>Cart Sub Total</td>
									<td>${{Cart::subtotal()}}</td>
								</tr>
								<tr>
									<td>Exo Tax</td>
									<td>$2</td>
								</tr>
								<tr class="shipping-cost">
									<td>Shipping Cost</td>
									<td>Free</td>
								</tr>
								<tr>
									<td>Total</td>
									<td><span>${{Cart::subtotal()}}</span></td>
								</tr>
								<tr>
									<td>
										<a class="btn btn-success">Make Checkout</a>
									</td>
									
								</tr>

							</table>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		@else
            <h2>No, items in cart</h2>
        @endif
	</div>
</section> <!--/#cart_items-->
@endsection	