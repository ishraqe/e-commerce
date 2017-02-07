<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Brand extends Model
{
  
    protected $fillable = array('brand_name','brand_image','category_id','brand_description','in_market_from');

     public function product()
    {
        return $this->hasMany(Product::class);
    }
}
