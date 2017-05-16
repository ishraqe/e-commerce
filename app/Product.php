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

    public function image(){

        return $this->hasMany(Image::class);
    }

    public function getAllProduct()
    {
        $product= DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->join('categories','products.category_id', '=','categories.id')
            ->join('brands','products.brand_id', '=','brands.id')
            ->select('products.*', 'images.*','categories.category_name','brands.brand_name')
            ->orderBy('products.created_at','desc')
           ->paginate(20);

        return $product;
    }

    public function getProduct(){
         $product= DB::table('products')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->join('categories','products.category_id', '=','categories.id')
            ->join('brands','products.brand_id', '=','brands.id')
            ->select('products.*', 'images.*','categories.*','brands.*');

        return $product;
    }

    public function getFeaturedProduct(){
        $featuredProduct=$this->getProduct()->where('is_featured',1)->orderBy('products.created_at','desc');

        return $featuredProduct;
    }

    public function recommended(){

        $recommended =$this->getProduct();
        return $recommended;
    }

    public function addproduct(Request $request){


    }

    public function getProductByCategory($id){
       return Product::where('category_id',$id)->get();

    }
    public function getProductByBrand($id){
        return Product::where('brand_id',$id)->get();

    }

}
