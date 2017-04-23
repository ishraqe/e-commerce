<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
use Auth;
class Notification extends Model
{
    protected  $fillable=['product_id','product_user_id','product_comment_id','product_comment_user_id','blog_id','blog_user_id','blog_comment_id','blog_comment_user_id','status'];

    public  function  getNotification(){

        $blogNoti= DB::table('users')
            ->join('notifications', 'users.id', '=', 'notifications.blog_comment_user_id')
            ->select('users.*', 'notifications.*')
            ->orderBy('notifications.created_at','desc')
            ->where('notifications.blog_user_id',Auth::user()->id)
            ->where('status',0);

        $notification = DB::table('users')
            ->join('notifications', 'users.id', '=', 'notifications.product_comment_user_id')
            ->select('users.*', 'notifications.*')
            ->orderBy('notifications.created_at','desc')
            ->where('notifications.product_user_id',Auth::user()->id)
            ->where('status',0)
            ->union($blogNoti)
            ->get();

        return $notification;
    }

}

