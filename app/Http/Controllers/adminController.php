<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use Session;
use DB;
use App\Order;
use App\Product;
use App\Category;
use App\Brand;
use App\Image;

use App\Http\Controller\ProductController;

class adminController extends Controller
{
   public function getLogin()
   {
   		return view('admin.login');
   }
   public function postLogin(Request $request){
   	 	$this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

	    if (Auth::attempt(['email'=> $request['email'],'password'=>$request['password']])) {

	        if(Auth::user()->admin){

	            return redirect('/admin/dashboard');
	        }else{
	             Session::flash('login_message','Something wrong with your credientials!');
	        }
	        
	    }else{
	       
	        Session::flash('login_message','Something wrong with your credientials!');
	    }
	    
	    return redirect()->back();
	}

	public function getDasborad()
	{
		$pro=new Product();
		$category=Category::all();
		$brand=Brand::all();
		$product=$pro->getAllProduct();

		return view('admin.dashboard')->with([
			'product'=>$product,
			'category'=>$category,
			'brand'=>$brand
		]);
	}

	public function addProduct(Request $request)
	{
		$this->validate($request, [
            'title' => 'required|max:25|min:4',
            'description' => 'required',
            'price' => 'required|int',
            'category_id' => 'required',
            'brand_id' => 'required',
            'image' =>'required'
        ]);

		$image = $request->file('image');
		try{
			 if ($image) {
	            $image_name = str_random(20);
	            $ext = strtolower($image->getClientOriginalExtension());
	            $image_full_name = $image_name . '.' . $ext;
	            $destination_path = 'product_images/';
	            $image_url ='/' .$destination_path . $image_full_name;
	            $success = $request->file('image')->move($destination_path, $image_full_name);
	           
	            if ($success) {
	                
	                $product = new Product();

	                $product->title = $request->title;
	                $product->category_id = $request->category_id;
	                $product->brand_id = $request->brand_id;
	                $product->description = $request->description;
	                $product->price = $request->price;
	                $product->rating=0;
	               	$product->image = $image_url;

	               $saveData= $product->save();

	               if ($saveData) {
	                    Session::flash('added_confirmation','Your data has been added!!');
	                    return redirect()->back();
	                }  
	                
	            }
	        }
		}catch(Exception $e){
			die($e->getMessage());
		}
       
	}
	public function showProduct()
	{
		$pro=new Product();
		$category=Category::all();
		$brand=Brand::all();
		$product=$pro->getAllProduct();

		return view('admin.product')->with([
			'product'=>$product,
			'category'=>$category,
			'brand'=>$brand
		]);
	}

	public function editProductInfo($id)
	{
		$product=Product::findOrfail($id);
		$category=Category::all();
		$brand=Brand::all();
		return view('admin.product.edit')->with([
			'product' =>$product,
			'category'=>$category,
			'brand'=>$brand
		]);
	}

	public function saveProductInfo(Request $request,$id)
	{
		$this->validate($request, [
            'title' => 'required|max:25|min:4',
            'description' => 'required',
            'price' => 'required|int',
            'category_id' => 'required|int',
            'brand_id' => 'required|int',
            'image' =>'required'
        ]);
        
        $image = $request->file('image');
		try{
			 if ($image) {
	            $image_name = str_random(20);
	            $ext = strtolower($image->getClientOriginalExtension());
	            $image_full_name = $image_name . '.' . $ext;
	            $destination_path = 'product_images/';
	            $image_url ='/' .$destination_path . $image_full_name;
	            $success = $request->file('image')->move($destination_path, $image_full_name);

	           
	            if ($success) {
	                
	               $product=Product::findOrfail($id);

	                $product->title = $request->title;
	                $product->category_id = $request->category_id;
	                $product->brand_id = $request->brand_id;
	                $product->description = $request->description;
	                $product->price = $request->price;
	               	$product->image = $image_url;

	               $saveData=  $product->update();

	               if ($saveData) {
				        Session::flash('update_confirmation','Your product info has been updated');
				        return redirect('/admin/product');
	                }  
	                
	            }
	        }
		}catch(Exception $e){
			die($e->getMessage());
		}     
	}

	public function deleteProduct($id)
	{
		$deleteProduct=Product::findOrfail($id)->delete();
        Session::flash('delete_confirmation','Your Product has been deleted');
		return redirect()->back();
	}

	public function getProfile(){
		return view('admin.page-profile');
	}
}
