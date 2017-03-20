<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cart;
use App\Wish;
use App\Http\Requests;
use App\Product;
use App\Order;
use App\User;
use App\Brand;
use App\Category;
use App\Review;
use DB;

use Session;
use Auth;
use App\WishList;

class ProductController extends Controller
{
     public function getIndex()
    {
        
       
    	$product=Product::all()->take(6);
            
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

    public function addToWishlist(Request $request,$id)
    {
        if (!Auth::guest()) {
            $product=Product::findOrfail($id);
            $wishlist = WishList::create([

                'product_id' => $product->id,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->back(); 
        }else{
            $product=Product::findOrfail($id);
            $oldWishlist=Session::has('wishlist') ? Session::get('wishlist') : null;
            $wish=new Wish($oldWishlist);
            $wish->add($product,$product->id);

            $request->session()->put('wish',$wish);  
            return redirect()->back(); 
        }
    }
    public function getCart(){
        $oldcart=[];
        $cart=[];
        if(!Session::has('cart')){
            return view('pages.cart');
        }else{
            
            $oldcart=Session::get('cart');
          
            $cart = new Cart($oldcart);
            
            return view('pages.cart',[
                'product'=>$cart->items,
                'totalPrice'=>$cart->totalPrice,

            ]);
        }
    }

    public function getWishList()
    {

        if (!Auth::guest()) {
            $wishlist=WishList::where('user_id', Auth::user()->id)->get();
            

            return view('pages.wish',[
                'wishlist'=>$wishlist
                
            ]);
        }else{
            $oldWish=[];
            $wish=[];
            if(!Session::has('wish')){
                return view('pages.wish');
            }else{
                
                $oldWish=Session::get('wish');
                $wish = new Wish($oldWish);
                

                return view('pages.wish',[
                    'product'=>$wish->items,
                    'totalPrice'=>$wish->totalPrice,
                    'image' => $wish->image
                ]);
            }
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

    public function updatIncreaseCart(Request $request){

        $input = $request->input();
        $numberOfProduct=Product::where('id',$input['id'])->first();

      

       if ($input['increasedProductNumber'] >  $numberOfProduct['number_of_products']) {
            $data = array(
                'status' => 500,
                'msg' => 'Can\'t do that' 
                );
            return $data;

       }else{

            if (!Session::has('cart')) {
                return view('pages.cart');
            }
            $oldcart=Session::get('cart');
            $cart=new Cart($oldcart);

            $total=$cart->totalPrice;
            $added=$total*$input['increasedProductNumber'] ;
            return [
               'status' => 200,

            ];
       }
    }

    public function categoryAll()
    {
       $category=Category::all();

       return view('pages.categories')->with([
            'category' => $category
        ]);

    }

    public function brandAll()
    {
        
        // $brand = DB::table('brands')
        //     ->join('products', 'brands.id', '=', 'products.brand_id')
        //     ->select('*')
        //     ->groupBY('brands.brand_name')
        //     ->get();    
        //     dd($brand);   


    $brand =Brand::orderBy('created_at','desc')->get();

  
    $products='';
        
        
        return view('pages.brand')->with([
            'brand' => $brand,
            'products' => $products
        ]);
    }

    public function getProductInfo(Request $request){

        $input = $request->input();

        $product=Product::findorfail($input['id']);
        $category=Category::all();
        $brand=Brand::all();

        $data=array(
            'status' => 200,
            'info' => array(
                'id' => $product['id'],
                'title' => $product['title'],
                'description'=>$product['description'],
                'price' => $product['price'],
                'number_of_product'=>$product['number_of_products'],
                'is_available' => $product['is_available'],
                'is_sold' => $product['is_sold'],
                'image'=>$product['image'],
                'category_id'=>$product['category_id'],
                'brand_id' => $product['brand_id']
            ),
            'category' => array(
              'category' => $category
            ),
            'brand' => array(
                'brand' => $brand
            )
        );

        return $data;
    }
    public function editProductInfo($id){
        return $id;
    }

}
