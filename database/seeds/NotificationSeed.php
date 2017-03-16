<?php

use Illuminate\Database\Seeder;

class NotificationSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $notification=new \App\Notification([
            'product_id'=>1,
            'product_user_id'=>1,
            'product_comment_id'=>1,
            'product_comment_user_id'=>2,
            'blog_id'=>0,
            'blog_user_id'=>0,
            'blog_comment_id'=>0,
            'blog_comment_user_id'=>0
        ]);
        $notification->save();
        
        $notification=new \App\Notification([
            'product_id'=>0,
            'product_user_id'=>0,
            'product_comment_id'=>0,
            'product_comment_user_id'=>0,
            'blog_id'=>1,
            'blog_user_id'=>1,
            'blog_comment_id'=>1,
            'blog_comment_user_id'=>2
        ]);
        $notification->save();
    }
}
