<?php

use Illuminate\Database\Seeder;

class imageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i <11 ; $i++) {

            $image = new \App\Image([
                'product_id' => $i,

                'image_header' => 'http://img1.exportersindia.com/product_images/bc-full/dir_104/3114679/apple-mobile-phones-1308287.jpg',

                'image_2' => 'https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcS8AxyBej_No8LT0w0J2ry3rw_NUw3Vqo7a7zXtF0r8CbNawrgM',
                'image_3' => 'http://orig09.deviantart.net/cb81/f/2009/140/0/e/bead_handycrafts_ii_by_sayekti777.jpg',
                'image_4' => 'http://4.bp.blogspot.com/-UE-0FxhpnzI/Vs9XGHvaetI/AAAAAAAAAKM/TCL_hisNtB0/s1600/Pair2.jpg'


            ]);
            $image->save();
        }

    }
   
}
