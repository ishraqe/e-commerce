<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
   protected $fillable=['user_id','mobile_number','about','website','user_image'];


   public function user()
    {
        return $this->belongsTo('App\User');
    }
}

