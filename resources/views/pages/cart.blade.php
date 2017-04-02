@extends('layouts.master')
 @section('title')
Shopping Cart
    
                            

@endsection  
@section('content')
    <section id="cart_items">
        <div class="container">
            <div class="breadcrumbs">
                <ol class="breadcrumb">
                    <li><a href="#">Home</a></li>
                    <li class="active"><a href="">Shopping Cart</a></li>
                </ol>
            </div>
            <div class="table-responsive cart_info">
                @if(Cart::content() !=null)

                    <table class="table table-condensed">
                        <thead>
                        <tr class="cart_menu">
                            <td class="image">Item</td>
                            <td class="description"></td>
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
                                <a href="#"><img src="{{$row->options->image}}" alt=""></a>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$row->name}}</a></h4>

                            </td>
                            <td class="cart_price">
                                <p>$ <span class="value">{{$row->price}}</span></p>
                            </td>
                            <td class="cart_quantity">
                                <input type="hidden" name="id">
                                <div class="cart_quantity_button" data-id="{{$row->rowId}}">
                                    <a class="cart_quantity_up" data-id="{{$row->id}}" onclick="increaseThisQuantity(this)"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity" value="{{$row->qty}}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down"  onclick="decreaseThisQuantity(this)"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p id="totalPriceOf" class="cart_total_price">${{$row->qty*$row->price}}</p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>

                @else
                    <h2>No, items in cart</h2>
                @endif
            </div>
        </div>
    </section>
    @if(Cart::content() !=null)
        <section id="do_action">
            <div class="container">
                <div class="heading">
                    <h3>What would you like to do next?</h3>
                    <p>Choose if you have a discount code or reward points you want to use or would like to estimate your delivery cost.</p>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="total_area">
                            <ul>
                                <li>Cart Sub Total <span>${{Cart::subtotal()}}</span></li>
                                <li>Eco Tax <span>Free</span></li>
                                <li>Shipping Cost <span>Free</span></li>
                                <li>Total <span>${{Cart::subtotal()}}</span></li>
                            </ul>

                            <a class="btn btn-default check_out" href="{{route('cart.checkout')}}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
  <!--/#do_action-->
    
                            

@endsection

@section('script')
    <script type="text/javascript">
        function increaseThisQuantity(trigger) {

            var trigger = $(trigger),
                container = trigger.parents('.cart_quantity_button'),
                raw = container.attr('data-id'),
                id=trigger.attr('data-id');
                target = trigger.parents('tr').find('input.cart_quantity_input'),
                curVal = parseFloat(target.val()),
                price= parseFloat(trigger.parents('tr').find('.cart_price .value').html()),
                param = {
                    "_token": "{{ csrf_token() }}",
                    raw : raw,
                    id : id,
                    'increasedProductNumber' : curVal+1

                };

            target.val(curVal+1);
            $.ajax({
                url: "/cart/update",
                method: "post",
                data: param,
                dataType: "json",
                success: function (res) {

                    if(res.status == 500){
                        target.val(curVal);
                        var html = '<p class="errorMsg">'+res.msg+'</p>';
                        trigger.parents('td').find('.errorMsg').remove();
                        trigger.parents('td').prepend(html);

                    }else if(res.status==200){
                        var totalPrice = price*(curVal+1);
                        trigger.parents('tr').find('.cart_total_price').html('$'+totalPrice);
                    }
                }
            })
            ;}



        function decreaseThisQuantity(trigger) {
            var trigger = $(trigger),
                container = trigger.parents('.cart_quantity_button'),
                id = container.attr('data-id'),
                target = trigger.parents('tr').find('input.cart_quantity_input'),
                curVal = parseFloat(target.val()),
                price= parseFloat(trigger.parents('tr').find('.cart_price .value').html()),
                param = {
                    "_token": "{{ csrf_token() }}",
                    id : id,
                    'increasedProductNumber' : curVal-1

                };

            if (curVal != 0 ) {
                target.val(curVal-1);
                $.ajax({
                    url: "/cart/decreaseProduct",
                    method: "post",
                    data: param,
                    dataType: "json",
                    success: function (res) {

                    }
                });
            }
            ;}
    </script>
@endsection