<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Brand;
use App\Category;
use App\Message;
use Auth;
use DB;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer(['layouts.master','layouts.admin'],function($view){
            $message=[];
            $notification=[];
            $category=Category::all()->take(9);




            if (!Auth::guest()) {
                $message= DB::table('messages')->where('receiver_id',Auth::user()->id)->get();

                $blogNoti= DB::table('users')
                    ->join('notifications', 'users.id', '=', 'notifications.blog_comment_user_id')
                    ->select('users.*', 'notifications.*')
                    ->orderBy('notifications.created_at','desc')
                    ->where('notifications.blog_user_id',Auth::user()->id);

                $notification = DB::table('users')
                    ->join('notifications', 'users.id', '=', 'notifications.product_comment_user_id')
                    ->select('users.*', 'notifications.*')
                    ->orderBy('notifications.created_at','desc')
                    ->where('notifications.product_user_id',Auth::user()->id)
                    ->union($blogNoti)
                    ->get();

            }




            $brand=Brand::all()->take(9);
            $view->with([
                'category'  => $category,
                'brand'  => $brand,
                'message' => $message,
                'notification' => $notification,
            ]);
        });

       

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
