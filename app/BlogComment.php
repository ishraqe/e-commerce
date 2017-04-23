<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BlogComment extends Model
{

	protected $fillable=['comment_user_id','blog_id','comment_body'];
 	

 	public function blog()
    {
        return $this->belongsTo(Blog::class);
    }
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
