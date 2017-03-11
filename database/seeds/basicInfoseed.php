<?php

use Illuminate\Database\Seeder;

class basicInfoseed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
       $basicInfoseed=new \App\BasicInfo([
       	'user_id'=>1,
       	'mobile_number'=>'electronics',
        'about' => 'nteractively fashion excellent information after distinctive outsourcing.',
        'website' => 'www.fb.com'
      
       	]);

       $basicInfoseed->save();
    }

}
