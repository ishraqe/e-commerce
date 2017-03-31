<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Brand;
use App\Blog;
use App\User;
use App\BlogComment;
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
        

        $comment = DB::table('blog_comments')
            ->join('users', 'blog_comments.comment_user_id', '=', 'users.id')
            ->select('*')
            ->where('blog_id','=',$blogDesc->id)
            ->get();        

       
        return view('pages.blog.blog-single')->with([
            'blogDesc'=>$blogDesc,
            'comment' => $comment
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

                    Blog::create([

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

    public function addComment(Request $request)
    {
       $input = $request->input();

       $comment=$input['comment'][0]['value'];
        
        $arrayData=[
            'comment_body' => $comment
        ];

        $validator = Validator::make($arrayData, [
            'comment_body' => 'required'
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
               'comment_user_id' => Auth::user()->id,
               'blog_id' => $input['id'],
               'comment_body' => $comment,
            );

            $username=User::where('id',$updateData['comment_user_id'])->select('name')->get();
          
            $comment = new BlogComment();
            
            $comment->comment_user_id = $updateData['comment_user_id'];
            $comment->blog_id=$updateData['blog_id'];
            $comment->comment_body=$updateData['comment_body'];

            $saveData =  $comment->save();

            if ($saveData){

                $blogComment = DB::table('blog_comments')
                ->select('*')
                ->where('blog_id','=',$updateData['blog_id'])
                ->get();

               
               $response=count($blogComment);
               $data=array(
                   'status' => 200,
                   'number_of_response' => $response,
                   'comments' => array(
                      'comments' => $blogComment
                    )         
               );
               
               return $data;
            }
        }        
    }

    public function editMyBlog(Request $request){
        $input=$request->all();

        $blogDesc=Blog::findOrfail($input['id']);




        $data=[
            'status' => 200,
            'info'   => array(
                'title'  => $blogDesc->title,
                'user_id' => $blogDesc->user_id,
                'short_description' => $blogDesc->short_description,
                'blog_header_image' => $blogDesc->blog_header_image,
                'blog_body' => $blogDesc->blog_body
            )
        ];

        return $data;

    }
}
