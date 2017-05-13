<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
class Image extends Model
{
   
    protected $fillable = array('product_id', 'image_header','image_2','image_3','image_4');
     
    public function product(){
    	return $this->belongsTo(Product::class);
    }

    public function imageProcessing($image){
        $image_name = str_random(20);
        $ext = strtolower($image->getClientOriginalExtension());
        $image_full_name = $image_name . '.' . $ext;
        $destination_path = '/product_images/';
        $image_url = '/' . $destination_path . $image_full_name;
        $success = $image->move($destination_path, $image_full_name);

        $data=[
            'image_url'=>$image_url,
            'success' => $success
        ];
        return $data;
    }

}
