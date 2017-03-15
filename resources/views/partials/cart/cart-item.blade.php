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
                                    <a href="#"><img src="images/cart/one.png" alt=""></a>
                                </td>
                                <td class="cart_description">
                                    <h4><a href="">{{$products['item']->title}}</a></h4>

                                    <p>id {{$products['item']->id}}</p>
                                </td>
                                <td class="cart_price">

                                    <p>$ <span class="value">{{$products['item']->price}}</span></p>
                                </td>
                                <td class="cart_quantity">
                                    <input type="hidden" name="id">  
                                    <div class="cart_quantity_button" data-id="{{$products['item']->id}}">
                                        <a class="cart_quantity_up" onclick="increaseThisQuantity(this)"> + </a>
                                        <input class="cart_quantity_input" type="text" name="quantity" value="{{$products['qty']}}" autocomplete="off" size="2">
                                        <a class="cart_quantity_down"  onclick="decreaseThisQuantity(this)"> - </a>
                                    </div>
                                </td>
                                <td class="cart_total">
                                    <p id="totalPriceOf" class="cart_total_price">${{$products['item']->price*$products['qty']}}</p>
                                </td>
                                <td class="cart_delete">
                                    <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
        @endforeach
                            <button name="submit" onclick="">Submit</button>
                    </form>
                </tbody>    
            </table>
       
         @else
         <h2>No, items in cart</h2>
         @endif   
        </div>
    </div>

<script type="text/javascript">
    function increaseThisQuantity(trigger) {    

        var trigger = $(trigger),        
        container = trigger.parents('.cart_quantity_button'),        
        id = container.attr('data-id'),        
        target = trigger.parents('tr').find('input.cart_quantity_input'),        
        curVal = parseFloat(target.val()),
        price= parseFloat(trigger.parents('tr').find('.cart_price .value').html()),
        param = {
            "_token": "{{ csrf_token() }}",
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
        target = $('input.cart_quantity_input'),        
        curVal = parseFloat(target.val()),
        param = {
            "_token": "{{ csrf_token() }}",
            id : id
        };  
        
        if (curVal != 0 ) {
            target.val(curVal-1);
            $.ajax({            
                url: "/cart/update",        
                method: "post",        
                data: param,        
                dataType: "json",        
                success: function (res) {        
                }     
            });
        }
    ;}
</script>

</section>