<?php

use Illuminate\Database\Seeder;

class reportSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $report=new \App\Report([
       	'reported_by'=>2,
       	'reported_id'=>3,
       	]);

       $report->save();

        $report=new \App\Report([
       	'reported_by'=>2,
       	'reported_id'=>3,
       	]);


        $report->save();
        $report=new \App\Report([
       	'reported_by'=>2,
       	'reported_id'=>3,
       	]);

       $report->save();

      
        $report=new \App\Report([
       	'reported_by'=>2,
       	'reported_id'=>3,
       	]);

       $report->save();
    }
    
}
