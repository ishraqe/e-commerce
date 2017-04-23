<?php

use Illuminate\Database\Seeder;

class todoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $todo=new \App\Todo([
            'todo_title'=>'do testing',
            'todo_body'=>'test teh test server and more',
            'assigned_by'=>1,
            'created_by'=>1,
            'assigned_to'=>1,
            'status' =>1,
            'due_date' => new DateTime()


        ]);
        $todo->save();
        $todo=new \App\Todo([
            'todo_title'=>'do fb',
            'todo_body'=>'test teh test server and more',
            'assigned_by'=>1,
            'created_by'=>1,
            'assigned_to'=>1,
            'status' =>1,
            'due_date' => new DateTime()


        ]);
        $todo->save();
        $todo=new \App\Todo([
            'todo_title'=>'do justice',
            'todo_body'=>'test teh test server and more',
            'assigned_by'=>1,
            'created_by'=>1,
            'assigned_to'=>1,
            'status' =>1,
            'due_date' => new DateTime()


        ]);
        $todo->save();
    }
}
