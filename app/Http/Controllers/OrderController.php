<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

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
   
}
