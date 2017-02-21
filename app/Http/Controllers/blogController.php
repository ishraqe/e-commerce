<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Brand;
use App\Blog;
use App\User;
use DB;
use Validator;
use Auth;
use Session;
class blogController extends Controller
{
    public function getBlog()
    {
        $category=Category::all();

        $brand=Brand::all();


        $blog=Blog::orderBy('created_at','desc')->paginate(4);



        return view('pages.blog.blog')->with([
            'category' => $category,
            'brand' => $brand,
            'blog' => $blog
        ]);
    }

    public function  showBlog($id){
        $blogDesc=Blog::findOrfail($id);

        
        return view('pages.blog.blog-single')->with([
            'blogDesc'=>$blogDesc
        ]);
    }

    public function create(Request $request)
    {
        
        $validator = Validator::make($request->all(),[
            'blogTitle' => 'required',
            'short_description' => 'required',
            'blogBody' => 'required'

        ]);


        if ($validator->fails())
        {
             return redirect()->back()->withErrors($validator, 'blogErrors');
        }else{

            if ($request->hasFile('blog_header_image')) {
            $image = $request->file('blog_header_image');
            $image_name = str_random(20);
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $destination_path = 'products_images/';
            $image_url ='/' .$destination_path . $image_full_name;
            $success = $request->file('blog_header_image')->move($destination_path, $image_full_name);
           
            if ($success){

                     $blog =  Blog::create([

                    'title' => $request['blogTitle'],
                    'user_id' => Auth::user()->id,
                    'short_description' => $request['short_description'],
                    'blog_body' =>  $request['blogBody'],
                    'blog_header_image' => $image_url,
                   
                 ]);

                Session::flash('added_confirmation','Your blog has been created successfully');

                return redirect()->back();
            }

        }           
        
    }
}
}