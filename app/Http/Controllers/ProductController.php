<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Http\Requests;
use App\Product;
use App\Order;
use App\User;
use App\Brand;
use App\Category;
use App\Review;
use DB;
use Session;

class ProductController extends Controller
{
     public function getIndex()
    {
        
       
    	$product=Product::all()->take(3);
            
        $category=Category::all(); 

        $brand=Brand::all();
        
               
         $recomended = DB::table('products')
            ->join('ratings', 'products.id', '=', 'ratings.product_id')
            ->join('images', 'products.id', '=', 'images.product_id')
            ->select('*')
            ->orderBy('ratings.rating','desc')
            ->take(3)
            ->get();

    	return view('pages.index')->with([
    		'product' => $product,
            'category' => $category,
            'brand'  => $brand,
            'recomended'=>$recomended
    	]);
    }


    public function show($id){
       
       $productDetails=Product::findOrfail($id);
       
       $category=Category::all(); 
       $relatedByCategory=Product::where('category_id',$productDetails->category->id)->take(4)->get();
       
       $brand=Brand::all();
       $relatedByBrand=Product::where('brand_id',$productDetails->brand->id)->take(4)->get();
       
       $review=Review::where('product_id',$id)->get();

       $recomended=Product::where('title' ,'LIKE',$productDetails->title)
                    ->orderBy('created_at','desc')
                    ->take(8)
                    ->get();

        return view('pages.product-details')->with([
            'productDetails' => $productDetails,
            'category' => $category,
            'relatedByCategory'=>$relatedByCategory,
            'brand'  => $brand,
            'relatedByBrand'=>$relatedByBrand,
            'review'=>$review
        ]);
    }
   
    public function shop(){
        $category=Category::all(); 
        $brand=Brand::all();
        $product=Product::paginate(12);
        
    	return view('pages.shop')->with([
            'product'=>$product,
            'category' => $category,
            'brand'  => $brand
        ]);
    }


    public function getAddToCart(Request $request,$id){
        
        $product=Product::findOrfail($id);
        $oldCart=Session::has('cart') ? Session::get('cart') : null;
        $cart=new Cart($oldCart);
        $cart->add($product,$product->id);

        $request->session()->put('cart',$cart);
        return redirect()->back();
    }


    public function getCart(){
        $oldcart=[];
        $cart=[];
        if(!Session::has('cart')){
            return view('pages.cart');
        }else{
            
            $oldcart=Session::get('cart');
            $cart = new Cart($oldcart);
            
            return view('pages.cart',['product'=>$cart->items,'totalPrice'=>$cart->totalPrice]);
        }
    }
    public function getCheckOut(Request $request){
        if (!Session::has('cart')) {
            return view('pages.cart');
        }
        $oldcart=Session::get('cart');
        $cart=new Cart($oldcart);
        $total=$cart->totalPrice;

        return view('pages.checkout',['total'=>$total]);
    }
    public function updateCart(Request $request){
        return "update cart";
    }


}
