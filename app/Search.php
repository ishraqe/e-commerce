<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Search extends Model
{
   public function searchAll($query){


       $category=DB::table('categories')
           ->select('category_name','id','table_name','type as about',DB::raw('NUll as image'))
           ->where('category_name','LIKE', $query);

       $brand=DB::table('brands')
           ->select('brand_name','id','table_name','brand_description as about',DB::raw('NUll as image'))
           ->where('brand_name','LIKE', $query);

       $blog=DB::table('blogs')
           ->select('title','id','table_name','short_description as about',DB::raw('NUll as image'))
           ->where('title','LIKE', $query);

       $product = DB::table('products')
           ->select('title','id','table_name','description as about',DB::raw('image'))
           ->where('title', 'LIKE', $query)
           ->union($category)
           ->union($brand)
           ->union($blog)
           ->simplePaginate(12);

       return $product;

   }
}
