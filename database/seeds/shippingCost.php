<?php

use Illuminate\Database\Seeder;

class shippingCost extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $shippingCost=new \App\shippingCost([
            'insideDhaka'=>50,
            'outsideDhaka'=>100
        ]);

        $shippingCost->save();


    }
}
