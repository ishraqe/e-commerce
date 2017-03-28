<?php

use Illuminate\Database\Seeder;

class messageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
    {
       $message=new \App\Message([
       	'sender_id'=>2,
       	'receiver_id'=>1,
       	'message_body' => 'having trobule',
           'status' => 0

      
       	]);

       $message->save();


       $message=new \App\Message([
       	'sender_id'=>3,
       	'receiver_id'=>1,
       	'message_body' => 'having awesome time',
           'status' => 0
      
       	]);

       $message->save();
    }
    
}
