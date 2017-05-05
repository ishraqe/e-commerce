<?php

use Illuminate\Database\Seeder;

class ProductModelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $var=10;
      $value = rand(0,1) == 1;

      for ($i=0; $i <$var ; $i++) { 
        
        $product=new \App\Product([
        'title'=>'lol',
        'category_id'=>1,
        'brand_id' => 1,
        'description'=> 'Lorem ipsum dolor sit amet, consectetur adipisicing elit,        sed do eiusmod tempor incididunt ut labore et dolore          magna aliqua. Ut enim ad minim veniam,quis nostrud            exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
    proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
   ',
        'price'=> 120,
        'number_of_products' => 3,
        'products_user_id'=>1,
        'is_sold' => false,
        'is_featured'=>$value


          ]);

       $product->save();
      }
       

       
    }
}
