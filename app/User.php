<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','admin' ,'email', 'password','marchent','is_reported','is_active'
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
    
}
