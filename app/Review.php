<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
   protected $fillable=[
  	'reviewer_name','reviewer_email','reviewer_description','reviewer_rating','product_id'
   ];
}
