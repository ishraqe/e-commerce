<?php

use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order=new \App\Order([
       	'product_id'=>1,
       	'order_state'=>0,
      	'order_by'=>'ishman',
      	'placeOfOrder'=>'gotham',
      	'contact_no'=>'0001111'
       	]);
       	$order->save();

       	 $order=new \App\Order([
       	'product_id'=>2,
       	'order_state'=>1,
      	'order_by'=>'ishman',
      	'placeOfOrder'=>'gotham',
      	'contact_no'=>'0001111'
       	]);
       	$order->save();
       	 $order=new \App\Order([
       	'product_id'=>3,
       	'order_state'=>0,
      	'order_by'=>'ishman',
      	'placeOfOrder'=>'gotham',
      	'contact_no'=>'0001111'
       	]);
       	$order->save();
       	 $order=new \App\Order([
       	'product_id'=>4,
       	'order_state'=>1,
      	'order_by'=>'ishman',
      	'placeOfOrder'=>'gotham',
      	'contact_no'=>'0001111'
       	]);
       	$order->save();
    }
    
}
