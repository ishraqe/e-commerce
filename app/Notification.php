<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected  $fillable=['product_id','product_user_id','product_comment_id','product_comment_user_id','blog_id','blog_user_id','blog_comment_id','blog_comment_user_id'];
}
