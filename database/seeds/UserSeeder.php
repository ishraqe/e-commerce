<?php

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { 
         $user=new \App\User([
       	'name'=>'ishman',
        'admin'=>1,
       	'email'=>'admin@admin.com',
      	'password'=>bcrypt(111111),

      	
       	]);

       	$user->save();

         $user=new \App\User([
        'name'=>'ishman',
        'email'=>'marchent@marchent.com',
        'password'=>bcrypt(111111),
        'marchent'=>1
        
        ]);
        $user->save();

         $user=new \App\User([
        'name'=>'ishman',
        'email'=>'user@user.com',
        'password'=>bcrypt(111111)
        
        ]);
        $user->save();
    }
}
