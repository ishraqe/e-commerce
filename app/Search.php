<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Search extends Model
{
   public function searchAll($query){

       $users = DB::table('users')
           ->select('name','id','table_name')
           ->where('name','LIKE', $query)
            ->where('admin',0);

       $category=DB::table('categories')
           ->select('category_name','id','table_name')
           ->where('category_name','LIKE', $query);

       $brand=DB::table('brands')
           ->select('brand_name','id','table_name')
           ->where('brand_name','LIKE', $query);

       $blog=DB::table('blogs')
           ->select('title','id','table_name')
           ->where('title','LIKE', $query);

       $product = DB::table('products')
           ->select('title','id','table_name')
           ->where('title', 'LIKE', $query)
           ->union($users)
           ->union($category)
           ->union($brand)
           ->union($blog)
           ->get();

       return $product;

   }
}
