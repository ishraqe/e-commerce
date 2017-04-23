<?php

use Illuminate\Database\Seeder;

class districtSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dist=['Dhaka','Faridpur','Gazipur', 'Gopalganj','Jamalpur','Kishoreganj','Madaripur',
            'Manikganj','Munshiganj','Mymensingh','Narayanganj','Narsingdi','Netrokona',
            'Rajbari','Shariatpur','Sherpur','Tangail','Bogra','Joypurhat','Naogaon','Natore',
            'Nawabganj','Pabna','Rajshahi','Sirajgonj','Dinajpur','Gaibandha','Kurigram',
            'Lalmonirhat','Nilphamari','Panchagarh','Rangpur','Thakurgaon','Barguna','Barisal',
            'Bhola','Jhalokati','Patuakhali', 'Pirojpur', 'Bandarban','Brahmanbaria','Chandpur','Chittagong','Comilla',
            'Cox\'s Bazar','Feni','Khagrachari','Lakshmipur',   'Noakhali','Rangamati','Habiganj','Maulvibazar',
            'Sunamganj','Sylhet', 'Bagerhat','Chuadanga','Jessore','Jhenaidah','Khulna','Kushtia','Magura',
            'Meherpur','Narail','Satkhira',];

        for ($i=0;$i<count($dist) ;$i++ ) {
            $district = new \App\District([
                'district_name' => $dist[$i]
            ]);
            $district->save();
        }
    }
}
