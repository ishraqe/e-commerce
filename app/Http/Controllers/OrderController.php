<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Cart;
use App\Order;
use App\order_product;
use App\shippingCost;
class OrderController extends Controller
{
    public function getOrder()
    {
        $order=new Order;
        $allOrder=$order->getOrderAll()->get();

        return view('admin.order.index')->with([
            'allOrder'=> $allOrder
        ]);

    }


    public function showOrder($id){
       
       $order=Order::findOrfail($id);

       return view('show')->with(['order'=>$order]);  
    }
   
    public function changeState(){
    	$order=Order::findOrfail($id);
    	$order->state=1;
    	$order->update();
       return redirect()->back(); 
    }

   
    public function deleteOrder(Request $request,$id){
        $order=Order::findOrfail($id);
       	$order->delete();
       return redirect()->back(); 
    }
   
   public function makeOrder(Request $request)
   {
       $this->validate($request,[
          'customer_name' => 'required',
          'customer_contact_no' => 'required',
          'customer_address' => 'required'
        ]);

       $input=$request->all();

        try{
            $uniqueId= uniqid();

            $order_receipt_id="F_".$uniqueId;

            $order = new Order;
             // order_state', 'order_by','placeOfOrder','contact_no'
            $order->order_state = 0;
            $order->order_by=$input['customer_name'];
            $order->placeOfOrder =$input['customer_address'];
            $order->contact_no = $input['customer_contact_no'];
            $order->receipt_no=$order_receipt_id;
           $saveOrderInfo= $order->save();
           
           $orderId=$order->id;
           
            if ($saveOrderInfo) {
               $cartItem=Cart::content();

              foreach ($cartItem as $item) {

                  $order_product=new order_product;

                  $order_product->order_id =$orderId;
                  $order_product->product_id = $item->id;
                  $order_product->qty = $item->qty;

                  $saveOrder= $order_product->save();
                  if ($saveOrder) {
                    if ( count(Cart::content())>0) {
                          Cart::destroy();

                    }
                  }
              }
            }
        }catch(Exception $e){
          die('Something went wrong, please try sometime later');
        }  
   }


}
