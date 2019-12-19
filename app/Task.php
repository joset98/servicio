<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{

    protected $fillable = [
        'id_client','id_institution','title','message', 'due_date', 'status',
    ];

    public function client()
    {
       return $this->belongsTo(Client::class,'id_client');
    }

    public function institution()
    {
       return $this->belongsTo(Institution::class,'id_institution');
    }

	 public function historytasks()
    {
       return $this->hasMany(HistoryTask::class,'id_task');
    }
  

    public function usertasks()
    {
       return $this->hasMany(UserTask::class,'id_task');
    }

}
