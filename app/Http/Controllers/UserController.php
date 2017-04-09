<?php

namespace App\Http\Controllers;

use App\BasicInfo;
use App\Image;
use Illuminate\Http\Request;
use App\User;
use Validator;
use App\Brand;
use App\Category;
use DB;
use App\Product;
use App\Blog;
use Session;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function getLoginPage()
    {
    	return view('pages.login');
    }

    public function getSignUp(Request $request)
    {
    	// will use this later
    	 // $this->validate($request, [
      //       'name' => ['required',
      //                   'min:5',
      //                   'max:10',
      //                   'regex:(^[a-zA-Z]\w{5,10}$)'
      //               ],

      //      'email' => [
      //                   'required',
      //                   'max:50',
      //                   'unique:users',
      //                   'regex:([a-zA-Z0-9_]+@([a-zA-Z0-9]+.(?:com|org|net|co.bd)))'
      //               ],

      //       'password' => [
      //                       'required',
      //                       'min:6',
      //                       'max:15',
      //                       'regex:(^(?=.*\d)(?=.*[a-z])(?=.*[_|-|@|!])(?=.*[A-Z]).{6,15}$)'
      //               ]
      //   ]);
    	 $validator = Validator::make($request->all(), [
          'name'=>'required|max:255',
    		  'email'=>'required|email|max:255|unique:users',
    		  'password'=>'required|min:6|confirmed'
        ]);
    	 if ($validator->fails()) {

             return redirect()->back()->withErrors($validator, 'SignUpError');
        }else{
        	if ($request->marchent) {
	    		 $user =  User::create([
		            'name' => $request['name'],
		            'email' => $request['email'],
		            'password' => bcrypt(request()['password']),
		            'marchent' =>$request->marchent
		        ]);
	    	}else{
	    		$user =  User::create([
		            'name' => $request['name'],
		            'email' => $request['email'],
		            'password' => bcrypt(request()['password'])
		            
		        ]);
	    	}

			
	    	 
	        Auth::login($user);

	        return redirect('/');
	    } 

    	
    }

    public function getSignIn(Request $request)
    {
    	
    	 $validator = Validator::make($request->all(), [
          'email'=>'required|email',
    		'password'=>'required'
        ]);
    	if ($validator->fails()) {

             return redirect()->back()->withErrors($validator, 'SignInError');
        }else{
        	if (Auth::attempt(['email'=> $request['email'],'password'=>$request['password']])){
    	    		if (!Auth::user()->admin) {
    	    			return redirect('/');
    	    		}else{
    	    			return redirect()->back()->with('login_error','Email and password didn\'t matched');
    	    		}
	        }else{
	        	return redirect()->back()->with('login_error','Email and password didn\'t matched');
	        }
        }
    	
    }
    public function logout()
    {
    	Auth::logout();
    	return redirect('/');
    }

    public function getAccount()
    {
       $category=Category::all(); 
        $brand=Brand::all();
      return view('user.regular.account')->with([
            'category' => $category,
            'brand'  => $brand
        ]);
    }

    public function getMyblog($id)
    {

      $category=Category::all();
      $brand=Brand::all();
      $myblog=Blog::where('user_id',$id)
              ->orderBY('created_at','desc')
              ->paginate(2);

      return view('pages.blog.user.myblog')->with([
        'myblog' => $myblog,
        'category'=>$category,
        'brand' => $brand
      ]);
    }

    public function getMyProduct(){
        $user =new User();
        $product = $user->getAvailableProduct();

        $cat=new Category();
        $category=$cat->getCateory();

        $br=new Brand();
        $brand=$br->getBrand();

        return view('user.product.myproducts')->with([
            'products'=>$product,
            'category' =>  $category,
            'brand'  => $brand
        ]);
    }

    public function addProduct(Request $request){


    }
    public function addBasicprofile(Request $request){
        $input=$request->all();

        $this->validate($request,[
           'first_name' => 'required',
            'last_name' => 'required',
            'mobile_number' => 'required',
            'postal_code'   => 'required|int',
            'about'   => 'required',
            'website' => 'required',
            'address' => 'required',
            'user_image'  => 'required'
        ]);
        $image = $request->file('user_image');
        $im=new Image();
        $data= $im->imageProcessing($image);

        BasicInfo::create([
           'user_id' => Auth::user()->id,
            'first_name' => $request['first_name'],
            'last_name' =>  $request['last_name'],
            'mobile_number' =>  $request['mobile_number'],
            'about'   =>  $request['about'],
            'website' =>  $request['website'],
            'user_image'  => $data['image_url'],
            'address' =>  $request['address'],
            'postal_code'   =>  $request['postal_code']
        ]);
        return redirect()-back();
    }
}

