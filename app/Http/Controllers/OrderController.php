<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
use Cart;
use App\shippingCost;
class OrderController extends Controller
{
    public function getOrder()
    {
     $order=Order::all();
     return view('show')->with(['order'=>$order]);   
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
        try{
            $order = new Order;
             // order_state', 'order_by','placeOfOrder','contact_no'
            $order->order_state = 0;
            $order->order_by = $request->customer_name;
            $order->placeOfOrder = $request->customer_address;
            $order->contact_no = $request->customer_contact_no;

           $saveOrderInfo= $order->save();
           
           $orderId=$order->id;
           
            if ($saveOrderInfo) {
               $cartItem=Cart::content();
              
              foreach ($cartItem as $item) {
                  $product_id=$item->id;
                  $product_qty=$item->qty;

                  $order_product=new order_product;
                  // 'order_id','product_id','qty'
                  $order_product->order_id =$orderId;
                  $order_product->product_id = $product_id;
                  $order_product->qty = $product_qty;

                  $saveOrder= $order->save();
                  if ($saveOrder) {
                    if ( count(Cart::content())>0) {
                          Cart::destroy();
                    }
                    return "order_saved";
                  }
              }
            }
        }catch(Exception $e){
          die('Something went wrong, please try sometime later');
        }  
   }
}
