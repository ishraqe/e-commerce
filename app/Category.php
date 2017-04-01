<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Category extends Model
{
   
    protected $fillable = array(   'type', 'category_name');

     public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function getCateory(){

        $category=Category::all()->toArray();

      return $category;
    }
}
