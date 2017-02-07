<?php

use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $brand=new \App\Brand([
       	'brand_name'=>'Apple',
        'category_id' =>1	,
         'brand_description'=> 'lorem',
         'in_market_from'=> '1-12-99'
       	]);

        $brand->save();
    }
}
