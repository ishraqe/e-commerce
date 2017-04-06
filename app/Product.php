<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
use Illuminate\Http\Request;
use Session;
use Validator;

class Product extends Model
{
   
    protected $fillable = array( 'title',  'category_id','brand_id','description','price','rating','image','number_of_products','products_user_id','is_available','is_sold','is_featured','is_in_slider');
    

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function brand(){
         return $this->belongsTo(Brand::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
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

    public function getFeaturedProduct(){
        $featuredProduct=Product::where('is_featured',1)->get();

        return $featuredProduct;
    }

    public function recommended(){

        $recommended =Product::all()->take(12);
        return $recommended;
    }

    public function addproduct(Request $request){


    }

    public function getProductByCategory($id){
       return Product::where('category_id',$id)->get();

    }
}
