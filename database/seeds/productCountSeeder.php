<?php

use Illuminate\Database\Seeder;

class productCountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $report=new \App\ProductCount([
       	'product_id'=>2,
       	'number_of_products'=>3,
       	]);

       $report->save();
    }
}
