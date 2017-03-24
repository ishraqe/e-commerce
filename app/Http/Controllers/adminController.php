<?php

namespace App\Http\Controllers;

use App\BasicInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;
use App\User;
use League\Flysystem\Exception;
use Session;
use DB;
use Validator;
use App\Order;
use App\Product;
use App\Category;
use App\Brand;
use App\Notification;

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

        $users=User::where(['is_reported'=>false,'admin'=>0,'is_active'=>true])->get();


		return view('admin.dashboard')->with([
			'product'=>$product,
			'category'=>$category,
			'brand'=>$brand,
            'users' => $users
		]);
	}

	public function addProduct(Request $request)
	{
		
		$validator = Validator::make($request->all(), [
            'title' => 'required|max:25|min:4',
            'description' => 'required',
            'price' => 'required|int',
            'category_id' => 'required',
            'brand_id' => 'required',
            'image' =>'required',
            'number_of_products' => 'required|int'
        ]);

       
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'addProductError');
        }else {

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
		               	dd($saveData);
		                    Session::flash('added_confirmation','Your data has been added!!');
		                    return redirect()->back();
		                }  
		                
		            }
		        }
			}catch(Exception $e){
				die($e->getMessage());
			}
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

	    try{
            Product::findOrfail($id)->delete();
            Session::flash('delete_confirmation','Your Product has been deleted');
            return redirect()->back();
        }catch (Exception $e){
	        return $e;
        }

	}

	public function getProfile(){


		return view('admin.page-profile');
	}
    public  function  editBasicProfile(Request $request){

        $validator = Validator::make($request->all(), [
            'mobile_number'=>'required|numeric',
            'website'=>'required',
            'user_image'=> 'mimes:jpeg,jpg,png',
            'about'    => 'required|max:100'
        ]);

       
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'editBasicError');
        }else {

        	try{
        			$image=$request['user_image'];

        			if (!empty($image)) {
        				$image_name = str_random(20);
			            $ext = strtolower($image->getClientOriginalExtension());
			            $image_full_name = $image_name . '.' . $ext;
			            $destination_path = 'product_images/';
			            $image_url ='/' .$destination_path . $image_full_name;


			            $success = $request->file('user_image')->move($destination_path, $image_full_name);

			          
			            $basicInfo = BasicInfo::where('user_id', Auth::user()->id)->first();


			            
		            	$basic=BasicInfo::findOrfail($basicInfo->id);

	                    $basic->mobile_number = $request['mobile_number'];
	                    $basic->about = $request['about'];
	                    $basic->website = $request['website'];
	                    $basic->user_image = $image_url;
	                    

	                    $saveData  = $basic->update();
		                
		               
		             
		               if ($saveData) {
					        Session::flash('update_confirmation','Your basic info has been updated');
					        return redirect()->back();
		                }
        			}else{
        				$basicInfo = BasicInfo::where('user_id', Auth::user()->id)->first();
		            	$basic=BasicInfo::findOrfail($basicInfo->id);

	                    $basic->mobile_number = $request['mobile_number'];
	                    $basic->about = $request['about'];
	                    $basic->website = $request['website'];
	                    
	                    $saveData  = $basic->update();
		           
		             
		               if ($saveData) {
					        Session::flash('update_confirmation','Your basic info has been updated');
					        return redirect()->back();
		                }
        			} 
			}catch(Exception $e){
				die($e->getMessage());
			}
        }
    }
	public function showUsers()
	{
		$users=User::where(['is_reported'=>false,'admin'=>0,'is_active'=>true])->take(8)->get();
		$reported_user=User::where(['is_reported'=>true,'admin'=>0])->get();
		$admin=User::where(['is_reported'=>false,'admin'=>1])->take(8)->get();
		$pending=User::where('is_active',false)->get();


		return view('admin.users.index')->with([
			'users' => $users,
			'reported_user' => $reported_user,
			'admin' => $admin,
			'pending' => $pending
		]);
	}
	public function getAlluser()
	{
		$users=User::where(['is_reported'=>false,'admin'=>0,'is_active'=>true])->paginate(12);


		return view('admin.users.users')->with([
			'users' => $users
		]);
	}
	public function getAllAdmin()
	{
		$admin=User::where(['is_reported'=>false,'admin'=>1])->get();
		$index=1;
		return view('admin.users.admin')->with([
			'admin' => $admin,'index' => $index
		]);
	}

	public function addNewAdmin(Request $request)
	{
	
		$validator = Validator::make($request->all(), [
            'name'=>'required|max:255',
            'email'=>'required|email|max:255|unique:users',
            'password'=> 'required|min:6',
            'confirm_password' => 'required|min:6|same:password' ,   
            'admin_type'  => 'required'
        ]);

       
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'adminadderror');
        }else {
        	$admin_type= base64_encode(serialize($request->admin_type));

    		$user =  User::create([
	            'name' => $request['name'],
	            'email' => $request['email'],
	            'admin'   =>true,
	            'admin_type' =>$admin_type,
	            'password' => bcrypt(request()['password'])

	        ]);
    		 
    		Session::flash('added_confirmation','Admin added successfully');
    		return redirect()->back();
        }
	}

	public function notificationLanding()
    {

        $notification=new Notification();

       $notification=  $notification->getNotification();

        return view('admin.notifications')->with([
            'notification' => $notification
        ]);
    }
    public function messageLanding(){
        return view('admin.message');
    }

}


