<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Brand;
use App\Blog;
use App\User;
use DB;

class blogController extends Controller
{
    public function getBlog()
    {
        $category=Category::all();

        $brand=Brand::all();


        $blog=Blog::paginate(4);



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
}
