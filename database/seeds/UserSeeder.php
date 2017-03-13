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
        $arry=[1,2,3];
        $admin_type= base64_encode(serialize($arry));
         $user=new \App\User([
       	'name'=>'ishman',
        'admin'=>1,
        'admin_type'=>$admin_type,
       	'email'=>'admin@admin.com',
      	'password'=>bcrypt(111111),


      	
       	]);
 
       	$user->save();

        
    }
}
