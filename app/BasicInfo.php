<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BasicInfo extends Model
{
   protected $fillable=['user_id','first_name','last_name','mobile_number','about','website','user_image','address','postal_code','district_id'];

   public function user()
    {
        return $this->belongsTo('App\User');
    }
}

