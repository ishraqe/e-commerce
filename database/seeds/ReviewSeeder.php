<?php

use Illuminate\Database\Seeder;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $review=new \App\Review([
       	'reviewer_name'=>'ishman',
       	'reviewer_email'=>'admin@admin.com',
      	'reviewer_description'=>'loem ispsum',
      	'reviewer_rating'=>5,
       	'product_id'=>1,
      	
      	
       	]);
       	$review->save();
       	 $review=new \App\Review([
       	'reviewer_name'=>'ishman',
       	'reviewer_email'=>'admin@admin.com',
      	'reviewer_description'=>'loem ispsum',
      	'reviewer_rating'=>5,
       	'product_id'=>1,
      	
      	
       	]);
       	$review->save();
       	 $review=new \App\Review([
       	'reviewer_name'=>'ishman',
       	'reviewer_email'=>'admin@admin.com',
      	'reviewer_description'=>'loem ispsum',
      	'reviewer_rating'=>5,
       	'product_id'=>1,
      	
      	
       	]);
       	$review->save();
       	 $review=new \App\Review([
       	'reviewer_name'=>'ishman',
       	'reviewer_email'=>'admin@admin.com',
      	'reviewer_description'=>'loem ispsum',
      	'reviewer_rating'=>5,
       	'product_id'=>1,
      	
      	
       	]);
       	$review->save();
    }
   
}
