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
        $order= DB::table('products')
            ->join('order_products', 'order_products.product_id', '=', 'products.id')
            ->select('products.*','order_products.*');

        return $order;
    }
}
