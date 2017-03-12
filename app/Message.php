<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable=['sender_id','receiver_id','message_body'];


    public function user(){

    	return $this->belongsTo(User::class);
	}
}


