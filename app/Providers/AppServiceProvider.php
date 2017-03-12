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
            $category=Category::all()->take(9); 

            $message= DB::table('messages')->where('receiver_id',Auth::user()->id)->get();

            
            
            $brand=Brand::all()->take(9); 
            $view->with([
                'category'  => $category,
                'brand'  => $brand,
                'message' => $message
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
