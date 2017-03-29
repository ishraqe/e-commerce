<?php

namespace App\Providers;

use App\Todo;
use Illuminate\Support\ServiceProvider;
use App\Brand;
use App\Category;
use App\Notification;
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

            $todoNoti=[];
            $category=Category::all()->take(9);

            if (!Auth::guest()) {
                $message= DB::table('messages')->where('receiver_id',Auth::user()->id)->get();
                $todo=new Todo();
                $todoNoti=$todo->getByAssignedTo();
                $notiObject=new Notification();
                $notification=$notiObject->getNotification();

            }




            $brand=Brand::all()->take(9);
            $view->with([
                'category'  => $category,
                'brand'  => $brand,
                'message' => $message,
                'notification' => $notification,
                'todoNoti'  => $todoNoti
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
