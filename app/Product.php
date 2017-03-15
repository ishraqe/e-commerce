<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;
use App\Brand;
use App\Order;
use App\Image;

class Product extends Model
{
   
    protected $fillable = array( 'title',  'category_id','brand_id','description','price','rating','image','number_of_products');
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(){
         return $this->belongsTo(Brand::class);
    }

    public function order(){
         return $this->hasMany(Order::class);
    }


    

    public function getAllProduct()
    {
       $product =Product::orderBy('created_at', 'desc')
               ->paginate(20);
        return $product;
    }
}
