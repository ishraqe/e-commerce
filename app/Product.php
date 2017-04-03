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

    public function addProduct(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required|max:25|min:4',
            'description' => 'required',
            'price' => 'required|int',
            'category_id' => 'required',
            'brand_id' => 'required',
            'image' => 'required',
            'number_of_products' => 'required|int',

        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'addProductError');
        } else {

            $image = $request->file('image');
            try {
                if ($image) {
                    $im=new Image();
                    $data= $im->imageProcessing($image);

                    if ($data['success']) {
                        $product = new Product();
                        $product->title = $request->title;
                        $product->category_id = $request->category_id;
                        $product->brand_id = $request->brand_id;
                        $product->description = $request->description;
                        $product->price = $request->price;
                        $product->rating = 0;
                        $product->image = $data['image_url'];
                        $product->is_featured=$request['is_featured'];

                        $saveData = $product->save();

                        if ($saveData) {
                            Session::flash('added_confirmation', 'Your data has been added!!');
                            return redirect()->back();
                        }

                    }
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }
}
