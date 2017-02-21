<?php

use Illuminate\Database\Seeder;

class blogComment extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comment=new \App\BlogComment([
       	'comment_user_id'=>1,
        'blog_id'=>17,
       	'comment_body'=>'admin@admin.com'
      
      	
       	]);

       	$comment->save();

       	$comment=new \App\BlogComment([
       	'comment_user_id'=>1,
        'blog_id'=>17,
       	'comment_body'=>'admin@admin.com'
      
      	
       	]);

       	$comment->save();

       	$comment=new \App\BlogComment([
       	'comment_user_id'=>0,
        'blog_id'=>17,
       	'comment_body'=>'admin@admin.com'
      
      	
       	]);

       	$comment->save();
    }
}

