<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $fillable=['title','user_id','blog_body','blog_header_image','vote'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
