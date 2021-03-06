<?php

namespace App\Http\Controllers;

use App\BasicInfo;
use App\Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use League\Flysystem\Exception;
use Session;
use DB;
use Validator;
use App\Todo;
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

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request['email'], 'password' => $request['password']])) {

            if (Auth::user()->admin) {

                return redirect('/admin/dashboard');
            } else {
                Session::flash('login_message', 'Something wrong with your credientials!');
            }

        } else {

            Session::flash('login_message', 'Something wrong with your credientials!');
        }

        return redirect()->back();
    }

    public function getDasborad()
    {
        $pro = new Product();
        $category = Category::all();
        $brand = Brand::all();
        $product = $pro->getProduct()->take(10)->get();

        $users = User::where(['is_reported' => false, 'admin' => 0, 'is_active' => true])->get();


        return view('admin.dashboard')->with([
            'product' => $product,
            'category' => $category,
            'brand' => $brand,
            'users' => $users
        ]);
    }

    public function addProduct(Request $request)
    {
        $input=$request->all();

        $imageList=explode(",",$input['product_files']);




        $validator = Validator::make($input, [
            'title' => 'required|max:25|min:4',
            'description' => 'required',
            'price' => 'required|int',
            'category_id' => 'required',
            'brand_id' => 'required',
            'number_of_products' => 'required|int',

        ]);


        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'addProductError');
        } else {

            $product = new Product();

            $product->title = $request->title;
            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->description = $request->description;
            $product->price = $request->price;
            $product->rating = 0;

            $product->is_featured=$request['is_featured'];

            $saveData = $product->save();

            if ($saveData) {
                $productId= $product->id;
                $imagePth="/products_images";
                $image=new Image();
                $image->product_id=$productId;
                if (count($imageList)==1) {
                    $image->image_header=$imagePth."/".$imageList[0];
                     
                }elseif (count($imageList)==2) {
                    $image->image_header=$imagePth."/".$imageList[0];
                    $image->image_2=$imagePth."/".$imageList[1];
                  
                }elseif (count($imageList)==3) {
                    $image->image_header=$imagePth."/".$imageList[0];
                    $image->image_2=$imagePth."/".$imageList[1];
                    $image->image_3=$imagePth."/".$imageList[2];
                    
                }elseif (count($imageList)==4) {
                    $image->image_header=$imagePth."/".$imageList[0];
                    $image->image_2=$imagePth."/".$imageList[1];
                    $image->image_3=$imagePth."/".$imageList[2];
                    $image->image_4=$imagePth."/".$imageList[3];
                }
             
                $saveImage=$image->save();
                if ($saveImage){
                    Session::flash('added_confirmation', 'Your data has been added!!');
                    return redirect()->back();
                }
            }
        }
    }


    public function showProduct()
    {
        $pro = new Product();
        $category = Category::all();
        $brand = Brand::all();
        $product = $pro->getAllProduct();

        return view('admin.product')->with([
            'product' => $product,
            'category' => $category,
            'brand' => $brand
        ]);
    }

    public function editProductInfo($id)
    {
        $product = Product::findOrfail($id);
        $category = Category::all();
        $brand = Brand::all();

        return view('admin.product.edit')->with([
            'product' => $product,
            'category' => $category,
            'brand' => $brand
        ]);
    }

    public function saveProductInfo(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|max:25|min:4',
            'description' => 'required',
            'price' => 'required|int',
            'category_id' => 'required|int',
            'brand_id' => 'required|int',
            'image' => 'required'
        ]);

        $image = $request->file('image');
        try {
            if ($image) {
                $im=new Image();
                $data= $im->imageProcessing($image);
                if ($data['success']) {

                    $product = Product::findOrfail($id);

                    $product->title = $request->title;
                    $product->category_id = $request->category_id;
                    $product->brand_id = $request->brand_id;
                    $product->description = $request->description;
                    $product->price = $request->price;
                    $product->image = $data['image_url'];
                    $saveData = $product->update();
                    if ($saveData) {
                        Session::flash('update_confirmation', 'Your product info has been updated');
                        return redirect('/admin/product');
                    }

                }
            }
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function deleteProduct(Request $request)
    {
        $input=$request->all();

         $data=[
            'status' => 200,
            'productId'=> $input['id']
        ];
        return $data;

    }
    public function makeDelete(Request $request)
    {
        $input=$request->all();
      
        $product=Product::findOrfail($input['id']);

        $delete=$product->delete();

        $data=[];
        if ($delete) {
            $data=[
                'status' => 200,
                'message'=> 'Product deleted successfully!!'

            ];
            return $data;
        }
        
            

    }

    public function getProfile()
    {

        return view('admin.page-profile');
    }

    public function editBasicProfile(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'mobile_number' => 'required|numeric',
            'website' => 'required',
            'user_image' => 'mimes:jpeg,jpg,png',
            'about' => 'required|max:100'
        ]);


        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'editBasicError');
        } else {

            try {
                $image = $request['user_image'];

                if (!empty($image)) {
                    $im=new Image();
                    $data= $im->imageProcessing($image);

                    $basicInfo = BasicInfo::where('user_id', Auth::user()->id)->first();

                    $basic = BasicInfo::findOrfail($basicInfo->id);
                    $basic->mobile_number = $request['mobile_number'];
                    $basic->about = $request['about'];
                    $basic->website = $request['website'];
                    $basic->user_image = $data['image_url'];

                    $saveData = $basic->update();


                    if ($saveData) {
                        Session::flash('update_confirmation', 'Your basic info has been updated');
                        return redirect()->back();
                    }
                } else {
                    $basicInfo = BasicInfo::where('user_id', Auth::user()->id)->first();
                    $basic = BasicInfo::findOrfail($basicInfo->id);

                    $basic->mobile_number = $request['mobile_number'];
                    $basic->about = $request['about'];
                    $basic->website = $request['website'];

                    $saveData = $basic->update();


                    if ($saveData) {
                        Session::flash('update_confirmation', 'Your basic info has been updated');
                        return redirect()->back();
                    }
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
    }

    public function showUsers()
    {
        $users = User::where(['is_reported' => false, 'admin' => 0, 'is_active' => true])->take(8)->get();
        $reported_user = User::where(['is_reported' => true, 'admin' => 0])->get();
        $admin = User::where(['is_reported' => false, 'admin' => 1])->take(8)->get();
        $pending = User::where('is_active', false)->get();


        return view('admin.users.index')->with([
            'users' => $users,
            'reported_user' => $reported_user,
            'admin' => $admin,
            'pending' => $pending
        ]);
    }

    public function getAlluser()
    {
        $users = User::where(['is_reported' => false, 'admin' => 0, 'is_active' => true])->paginate(12);


        return view('admin.users.users')->with([
            'users' => $users
        ]);
    }

    public function getAllAdmin()
    {
        $admin = User::where(['is_reported' => false, 'admin' => 1])->get();
        $index = 1;
        return view('admin.users.admin')->with([
            'admin' => $admin, 'index' => $index
        ]);
    }

    public function addNewAdmin(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
            'confirm_password' => 'required|min:6|same:password',
            'admin_type' => 'required'
        ]);


        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator, 'adminadderror');
        } else {
            $admin_type = base64_encode(serialize($request->admin_type));

            $user = User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'admin' => true,
                'admin_type' => $admin_type,
                'password' => bcrypt(request()['password'])

            ]);

            BasicInfo::create([
               'user_image' =>  '/assets/img/admin.svg'
            ]);

            Session::flash('added_confirmation', 'Admin added successfully');
            return redirect()->back();
        }
    }

    public function notificationLanding()
    {

        $notification = new Notification();

        $notification = $notification->getNotification();

        return view('admin.notifications')->with([
            'notification' => $notification
        ]);
    }

    public function messageLanding()
    {
        return view('admin.message');
    }

    public function getTodo()
    {
        $data = new Todo();
        $us=new User();
        $allTodo = $data->allTodo();

        $id = Auth::user()->id;
        $user=$us->getAdmin();
        $status = array(
            'todo' => 0,
            'done' => 1
        );

        $myTodo = $data->getbyId($id, $status['todo']);
        $myDone = $data->getbyId($id, $status['done']);

        return view('admin.todo.todo')->with([
            'allTodo' => $allTodo,
            'myTodo' => $myTodo,
            'myDone' => $myDone,
            'admin' => $user
        ]);

    }

    public function addTodo(Request $request){

        $validator = Validator::make($request->all(), [
            'todo_title' => 'required',
            'todo_body' => 'required',
            'assigned_to' => 'required',
            'due_date' => 'required'
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator, 'addTodoError');
        }else{
            Todo::create([
                'todo_title' => $request['todo_title'],
                'todo_body' => $request['todo_body'],
                'assigned_by'=>Auth::user()->id,
                'created_by'=>Auth::user()->id,
                'assigned_to' =>$request['assigned_to'],
                'status'=>false,
                'due_date' => $request['due_date']
            ]);

            Session::flash('added_confirmation', 'Todo added successfully');
            return redirect()->back();
        }
    }

    public function changeTodoStatus(Request $request)
    {
        $input = $request->all();

        $todoId = $input['id'][0];


        $todo = new Todo();

        $individualTodo = $todo->getByOnlyId($todoId);

        $updateData = array(
            'status' => 1
        );


        $saveData = $individualTodo->update($updateData);


        if ($saveData) {
            $id = Auth::user()->id;

            $status = array(
                'todo' => 0,
                'done' => 1
            );
            $data = new Todo();
            $myTodo = $data->getbyId($id, $status['todo']);
            $myDone = $data->getbyId($id, $status['done']);
            $data = array(
                'status' => 200,

                'todo' => array(
                    'todo' => $myTodo
                ),
                'done' => array(
                    'done' => $myDone
                )
            );
            return $data;
        }


    }

    public function editTodo(Request $request)
    {
        $id = $request['id'];
        $data = new Todo();
        $user = new User();

        $getTodo = $data->getByOnlyId($id);

        $admin = $user->getAdmin();


        $adminInfo = [];
        $mainInfo = [];
        foreach ($admin as $a) {

            $adminInfo['id'] = $a->id;
            $adminInfo['name'] = $a->name;

            if ($a->basicInfo['user_image'] != null) {
                $adminInfo['image'] = $a->basicInfo['user_image'];
            } else {
                $adminInfo['image'] = 0;
            }

            array_push($mainInfo, $adminInfo);


        }
        $data = [
            'status' => 200,
            'info' => array(
                "id" => $getTodo->id,
                "todo_title" => $getTodo->todo_title,
                "todo_body" => $getTodo->todo_body,
                "assigned_by" => $getTodo->assigned_by,
                "created_by" => $getTodo->created_by,
                "assigned_to" => $getTodo->assigned_to,
                "status" => $getTodo->status,
                "due_date" => $getTodo->due_date
            ),
            'adminInfo' => array(

                'adminInfo' => $mainInfo
            )
        ];
        return $data;
    }

    public function updateTodo(Request $request)
    {
        $input = $request->all();

        $data = new Todo();
        $getTodo = $data->getByOnlyId($input['id']);

        $arrayData = [
            'todo_title' => $input['todo_title'],
            'todo_body' => $input['todo_body'],
            'assigned_by' => $getTodo->assigned_by,
            'assigned_to' => $input['assigned_to'],
            'status' => $getTodo->status,
            'due_date' => $input['todo_title']
        ];

        $validator = Validator::make($arrayData, [
            'todo_title' => 'required',
            'todo_body' => 'required',
            'assigned_to' => 'required',
            'due_date' => 'required'
        ]);


        if ($validator->fails()) {
            $error = $validator->errors()->all();

            $data = array(
                'status' => 500,
                'error' => $error
            );
            return $data;
        } else {

            $newData = array(
                'id' => $input['id'],
                'todo_title' => $input['todo_title'],
                'todo_body' => $input['todo_body'],
                'due_date' => $input['due_date'],
                'assigned_to' => isset($input['assigned_to']) ? $input['assigned_to'] : null,
                'assigned_by' => Auth::user()->id,
                'created_by' => Auth::user()->id,
                'status' => 0
            );
            $todo = new Todo();

            $saveData = $todo->where('id', $input['id'])->update($newData);
            if ($saveData) {

                $data = array(
                    'status' => 200,
                    'todo' => $newData
                );


                return $data;
            }
        }
    }
    public function notificationMakeRead(Request $request){
        $noti =new Notification();
        $notification=$noti->getNotification();



        foreach ($notification as $n){

            $affected = DB::table('notifications')
                ->where('id', $n->id)
                ->update(['status' => 1]);
        }

            $noti =new Notification();
            $notification=$noti->getNotification();

            $data=[
              'status' => 200,
                'notification'=>count($notification)

            ];
            return $data;

    }

    public function getCatBrand(){
        $cat=new Category();
        $br=new Brand();
        $allCategory = $cat->getCateory();
        $brand=$br->getBrand();

       return view('admin.categoriesAndBrand.index')->with([
            'categories' => $allCategory,
            'brand' => $brand
       ]);

    }

    public function addCategory(Request $request){



        $this->validate($request,[
            'category_name' => 'required|alpha|unique:categories|max:50'
        ]);


        $cateName=$request['category_name'];

        $category=new Category();

        try{

            $category->category_name = $cateName;

            $saveData = $category->save();
            if ($saveData) {
                Session::flash('added_confirmation', 'Your data has been added!!');
                return redirect()->back();
            }
        }catch (Exception $e){
            die('Something went wrong!');
        }
    }

    public function editCategory(Request $request){
        $input=$request->all();

        $id=$input['id'];

        $categories=Category::find($id)->toArray();

        $data=[
          'status' => 200,
          'category' => $categories
        ];
        return $data;
    }

    public function saveUpdateCategory(Request $req){
        $input=$req->all();

        $data = new Category();
        $getCategory = $data->getCategoryById($input['id']);


        $arrayData = [
            'category_name' => $input['category_name']
        ];

        $validator = Validator::make($arrayData, [
            'category_name' => 'required|alpha'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();

            $data = array(
                'status' => 500,
                'error' => $error
            );
            return $data;
        }else{
            $newData = array(
                'id' => $input['id'],
                'category_name' => $input['category_name']
            );


            $saveData = $getCategory->where('id', $input['id'])->update($newData);
            if ($saveData) {
                $data = array(
                    'status' => 200
                );
                return $data;
            }
        }
    }
    public function deleteCategory(Request $req){
        $input=$req->all();
        $cat=new Category();
        $category=$cat->getCategoryById($input['id']);

        if (count($category)>0){

           $pro=new Product();

           $product=$pro->getProductByCategory($input['id'])->toArray();

           $br=new Brand();

           $brand=$br->getBrandByCategory($input['id'])->toArray();

           if (count($product)>0 && count($brand)>0){

               $data=[
                   'status' => 500,
                   'message' => 'You can not delete this category cz there are so many products and brands under this category'
               ];
               return $data;

           }else{

              $delete= $category->delete();

               if ($delete){

                   $data=[
                       'status'=> 200,
                       'message'=> 'Your category had been deleted!!'

                   ];

                   return $data;
               }

           }
        }

    }

    public function addNewBrand(Request $req){
        $input=$req->all();

        $arrayData = [
            'brand_name' => $input['brand'][0]['value'],
             'category_id' =>$input['brand'][1]['value'],
            'description' =>$input['brand'][2]['value'],
            'started_from' =>$input['brand'][3]['value']
        ];
        $validator = Validator::make($arrayData, [
            'brand_name' => 'required',
            'category_id' =>'required|int',
            'description' =>'required|max:255',
            'started_from' => 'required'
        ]);

        if ($validator->fails()) {
            $error = $validator->errors()->all();

            $data = array(
                'status' => 500,
                'error' => $error
            );
            return $data;
        }else{
            $newData = array(
                'brand_name' => $arrayData['brand_name'],
                'category_id' =>$arrayData['category_id'],
                'brand_description'=>$arrayData['description'],
                'in_market_from' => $arrayData['started_from']
            );

            $brand=new Brand();
            $brand->brand_name = $newData['brand_name'];
            $brand->category_id=$newData['category_id'];
            $brand->brand_description=$newData['brand_description'];
            $brand->in_market_from=$newData['in_market_from'];

            $save= $brand->save();

               if ($save){
                    $data=[
                      'status' =>200
                    ];
                    return $data;
               }
        }
    }
    public function editBrand(Request $request){
        $input=$request->all();

        $id=$input['id'];

        $brand=Brand::find($id)->toArray();
        $cat=new Category();
        $categories=$cat->getCateory()->toArray();

        $data=[
            'status' => 200,
            'brand' => $brand,
            'categories'=> $categories
        ];
        return $data;
    }
    public function saveUpdateBrand(Request $request){
        $input=$request->all();
        $id=$input['id'];



        $arrayData = [
            'brand_name' => $input['brand'][0]['value'],
            'category_id' =>$input['brand'][1]['value'],
            'description' =>$input['brand'][2]['value'],
            'started_from' =>$input['brand'][3]['value']
        ];

        $validator = Validator::make($arrayData, [
            'brand_name' => 'required',
            'category_id' =>'required|int',
            'description' =>'required|max:255',
            'started_from' => 'required'
        ]);
        if ($validator->fails()) {
            $error = $validator->errors()->all();

            $data = array(
                'status' => 500,
                'error' => $error
            );
            return $data;
        }else{
            $newData = array(
                'brand_name' => $arrayData['brand_name'],
                'category_id' =>$arrayData['category_id'],
                'brand_description'=>$arrayData['description'],
                'in_market_from' => $arrayData['started_from']
            );

            $brand=Brand::find($id);
            $brand->brand_name = $newData['brand_name'];
            $brand->category_id=$newData['category_id'];
            $brand->brand_description=$newData['brand_description'];
            $brand->in_market_from=$newData['in_market_from'];

            $save= $brand->save();

            if ($save){
                $data=[
                    'status' =>200
                ];
                return $data;
            }
        }
    }
    public function deleteBrand(Request $request){
        $input=$request->all();

        $br=new Brand();
        $brand=$br->getBrandById($input['id']);

        if (count($brand)>0){

            $pro=new Product();

            $product=$pro->getProductByBrand($input['id'])->toArray();


            if (count($product)>0){

                $data=[
                    'status' => 500,
                    'message' => 'You can not delete this category cz there are so many products ' ];
                return $data;

            }else{

                $delete= Brand::find($input['id'])->delete();

                if ($delete){

                    $data=[
                        'status'=> 200,
                        'message'=> 'Your brand had been deleted!!'

                    ];

                    return $data;
                }

            }
        }

    }
}


