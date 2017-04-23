<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;
use Auth;
class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','admin','admin_type' ,'email', 'password','marchent','is_reported','is_active'
    ];
    
    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function blog()
    {
        return $this->hasMany(Blog::class);
    }


    public function blogComment()
    {
        return $this->hasMany(BlogComment::class);
    }

    
    
    public function basicInfo()
    {
        return $this->hasOne(BasicInfo::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
    public function product()
    {
        return $this->hasMany(Product::class);
    }

    public function todo()
    {
        return $this->hasMany(Todo::class);
    }

    public function getAdmin(){
        return User::where('admin',1)->get();
    }

    public function getAvailableProduct(){
        $product= DB::table('products')
            ->select('*')
            ->orderBy('created_at','desc')
            ->where('products_user_id',Auth::user()->id)
            ->where('is_sold',0)
            ->get();
       return $product;
    }
}
