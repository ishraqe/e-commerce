<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

     $this->call(CategorySeeder::class);
     $this->call(BrandSeeder::class);
     $this->call(ProductModelSeeder::class);
     $this->call(ReviewSeeder::class);
     $this->call(UserSeeder::class);
     $this->call(blogSeeder::class);
     $this->call(blogComment::class);
     $this->call(basicInfoseed::class);
     $this->call(messageSeeder::class);
     $this->call(reportSeeder::class);
     $this->call(NotificationSeed::class);
     $this->call(todoSeeder::class);
     $this->call(shippingCost::class);
     $this->call(districtSeeder::class);
     $this->call(imageSeeder::class);
     
        
    
    }
}
