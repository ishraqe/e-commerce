<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Image extends Model
{
   
    protected $fillable = array('product_id', 'image');
     
    public function product(){
    	return $this->belongsTo(Product::class);
    } 

}
