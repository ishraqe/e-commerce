<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use DB;
class Order extends Model
{

	 protected $fillable = [
         'order_state', 'order_by','placeOfOrder','contact_no','receipt_no',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getOrderAll(){
        $order= DB::table('order_products')
            ->join('orders', 'order_products.order_id', '=', 'orders.id')
            ->select('orders.*','order_products.product_id','order_products.qty');



        return $order;
    }
}
