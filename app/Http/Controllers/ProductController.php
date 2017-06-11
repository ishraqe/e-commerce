<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

use App\Wish;
use App\Product;
use App\Brand;
use App\Category;
use App\Review;
use DB;
use Validator;
use Session;
use Auth;
use App\WishList;
use Cart;
use App\shippingCost;

class ProductController extends Controller
{
    public function getIndex()
    {
        $productData = new Product();
        $featured = $productData->getFeaturedProduct()->take(10)->get();


        $categoryData = new Category();
        $category = $categoryData->getCateory()->take(10)->toArray();

        $recommended = $productData->recommended()->take(10)->get();

        $brandData = new Brand();
        $brand = $brandData->getBrand();

    
        return view('pages.index')->with([

            'category' => $category,
            'brand' => $brand,
            'recommended' => $recommended,
            'featured' => $featured
        ]);

        // ?category=<?= //$c->category_name;
    }


    public function show($id)
    {
        $product=new Product();
        $productDetails = $product->getProduct()->where('products.id',$id)->get();
     

        $category = Category::all();

        $relatedByCategory = Product::where('category_id', $productDetails[0]->category_id)->take(4)->get();

        $brand = Brand::all();
        $relatedByBrand = Product::where('brand_id', $productDetails[0]->brand_id)->take(4)->get();

        $review = Review::where('product_id', $id)->get();

        $recomended = Product::where('title', 'LIKE', $productDetails[0]->title)
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();


        return view('pages.product-details')->with([
            'productDetails' => $productDetails,
            'category' => $category,
            'relatedByCategory' => $relatedByCategory,
            'brand' => $brand,
            'relatedByBrand' => $relatedByBrand,
            'review' => $review
        ]);
    }

    public function shop()
    {
        $category = Category::all();
        $brand = Brand::all();
        $product = Product::paginate(12);

        return view('pages.shop')->with([
            'product' => $product,
            'category' => $category,
            'brand' => $brand
        ]);
    }

    public function categoriesProduct($id)
    {
        $products = Product::where('category_id', $id)->paginate(12);

        return view('pages.category-product')->with([
            'product' => $products
        ]);
    }

    public function brandsProduct($id)
    {
        $products = Product::where('brand_id', $id)->paginate(12);

        return view('pages.brand-product')->with([
            'product' => $products
        ]);
    }

    public function getAddToCart(Request $request)
    {
        $input=$request->all();
        $productId=$input['id'];

        if (isset($request['quantity'])){
            $qty=$request['quantity'];
        }else{
            $qty=1;
        }

           $product = Product::findOrfail($productId);
           $productImage= DB::table('images')
                        ->where('product_id',$productId)
                        ->get();



           Cart::add(['id' => $product->id,
                'name' =>$product->title,
                'qty' => $qty,
                'price' => $product->price,
                'options' => [
                    'category_id'=>$product->category_id ,
                    'brand_id' =>$product->brand_id ,
                    'description' =>$product->description ,
                    'image' => $productImage[0]->image_header,
                    'products_user_id' =>$product->products_user_id ,
                    'number_of_products'=>$product->number_of_products
                ]

           ]);

        return [
            'status' => 200,
            'subTotal' =>  Cart::subtotal(),
            'count'   => Cart::count()
        ];
    }

    public function addToWishlist(Request $request, $id)
    {
        if (!Auth::guest()) {
            $product = Product::findOrfail($id);
            $wishlist = WishList::create([

                'product_id' => $product->id,
                'user_id' => Auth::user()->id,
            ]);

            return redirect()->back();
        } else {
            $product = Product::findOrfail($id);
            $oldWishlist = Session::has('wishlist') ? Session::get('wishlist') : null;
            $wish = new Wish($oldWishlist);
            $wish->add($product, $product->id);

            $request->session()->put('wish', $wish);
            return redirect()->back();
        }
    }

    public function getCart()
    {
        $cost=new shippingCost();
       $shippingCost=$cost->getShippingData();

        return view('pages.cart')->with(['shippingCost'=> $shippingCost]);

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
        $cost=new shippingCost();
        $shippingCost=$cost->getShippingData();

        return view('pages.checkout')->with([
            'shippingCost' => $shippingCost
        ]);
    }

    public function updatIncreaseCart(Request $request){

        $input = $request->input();

        $id=$input['id'];
        $rowId=$input['raw'];


        $numberOfProduct=Product::where('id',$id)->first();



       if ($input['increasedProductNumber'] >  $numberOfProduct['number_of_products']) {
            $data = array(
                'status' => 500,
                'msg' => 'Can\'t do that' 
                );
            return $data;

       }else{
           $product=Cart::get($rowId);

           Cart::update($rowId, [
               'qty' => $input['increasedProductNumber']
           ]);


            return [
               'status' => 200,
                'totalPrice' => Cart::subtotal(),
                'numberOfProducts'=>Cart::count()
            ];
       }
    }
    public function updateDecreaseCart(Request $request){
        $input = $request->input();

        $rowId=$input['raw'];
        $product=Cart::get($rowId);

        Cart::update($rowId, [
            'qty' => $input['deccreasedProductNumber']
        ]);


        return [
            'status' => 200,
            'totalPrice' => Cart::subtotal(),
            'numberOfProducts'=>Cart::count()
        ];


    }
    public function deleteCartItem($rowId){
        if ($rowId !=null){
            Cart::remove($rowId);

            Session::flash('delete_confirmation', 'Your item is deleted from the cart!');
            return redirect()->back();
           
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
                'category_id'=>$product['category_id'],
                'brand_id' => $product['brand_id'],
                'is_featured' => $product['is_featured']
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
    public function saveupdateproduct(Request $request){

        $input = $request->input();

        $files = $request->allFiles();
        
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|int',
            'category_id' => 'required',
            'brand_id' => 'required',
            'number_of_products' => 'required|int'
        ]);
        if ($validator->fails()) {
            $error=$validator->errors()->all();

            $data=array(
                'status' => 500,
                'error' =>$error
            );
            return $data;
        }else {


            $updateData = array(
                'title' => $input['title'],
                'price' => $input['price'],
                'brand_id' => $input['brand_id'],
                'category_id' => $input['category_id'],
                'number_of_products' => $input['number_of_products'],
                'description' => $input['description'],
                'is_featured' => $input['is_featured']
            );

            $product = new Product();

            $saveData=  $product->where('id',$input['id'])->update($updateData);
            if ($saveData){

                $updateData['id']=$input['id'];
                $image = DB::table('products')
                    ->where('id',$input['id'])
                    ->select('image')->get();

                $data=array(
                    'status' => 200,
                    'product' =>$updateData,
                    'image' => $image[0]->image
                );
                return $data;
            }


        }

    }
    public function categorisedProduct(Request $request){
        
        $input=$request->all();
        $id=$input['id'];
        $pro=new Product();
        $product=$pro->getProduct()->where('products.category_id',$id)->take(8)->get();
        if (count($product)>0) {
                $data=[
                'status' => 200,
                'product' => [
                    'product' => $product
                ]
            ];
        }else{
             $data=[
                'status' => 500,
                'message' => 'No products found by this category'
            ];


        }
        

        return $data;
    }

}
