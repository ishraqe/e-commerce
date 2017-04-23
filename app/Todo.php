<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Auth;

class Todo extends Model
{
    protected $fillable = [
        'todo_title','todo_body','assigned_by' ,'created_by', 'assigned_to','status','due_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function allTodo(){

        return Todo::all();
    }

    public function getbyId($id,$status){

        return Todo::where(['assigned_to'=>$id,'status'=>$status])->get();
    }
    public function getByAssignedTo(){
        return Todo::where('assigned_to',Auth::user()->id)
         ->where('status',0)
         ->get();
    }
    public function getByOnlyId($id){

        return Todo::findOrfail($id);
    }
}
