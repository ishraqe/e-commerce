<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable=['title','user_id','short_description','blog_body','blog_header_image','vote'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function blogComment()
    {
        return $this->hasMany(BlogComment::class);
    }

}
