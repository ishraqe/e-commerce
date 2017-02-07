<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="#">Home</a></li>
              <li class="active"><a href="">Shopping Cart</a></li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
        @if(Session::has('cart'))
         
         <input type="hidden" name="_token" value="{{csrf_token()}}">
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
               
                 @foreach($product as $products)
                    <tr>
                        <td class="cart_product">
                            <a href=""><img src="images/cart/one.png" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href="">{{$products['item']->title}}</a></h4>
                            <p>Web ID: 1089772</p>
                        </td>
                        <td class="cart_price">

                            <p>$ {{$products['item']->price}}</p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value="{{$products['qty']}}" autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">${{$products['item']->price*$products['qty']}}</p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>    
            </table>
            <a class="btn btn-default update" href="#" name="submit"  >Update</a>
       
         @else
         <h2>No, items in cart</h2>
         @endif   
        </div>
    </div>
</section>