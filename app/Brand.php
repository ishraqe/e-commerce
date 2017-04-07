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

    public function getBrand(){
        $brand=Brand::all();
        return $brand;
    }

    public function getBrandByCategory($id){
        return Brand::where('category_id',$id)->get();
    }

    public function getBrandById($id){
        return Brand::where('id',$id)->get();
    }
}
