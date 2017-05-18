<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Order extends Model
{

	 protected $fillable = [
         'order_state', 'order_by','placeOfOrder','contact_no',
    ];

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
