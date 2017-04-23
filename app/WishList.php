<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class WishList extends Model
{
   protected $fillable = [
        'product_id','user_id',
    ];
}
