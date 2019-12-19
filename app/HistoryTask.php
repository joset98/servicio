<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HistoryTask extends Model
{
    protected $fillable = [
        'id_task','id_user','status',
    ];

	public function user()
    {
       return $this->belongsTo(User::class,'id_user');
    }

	public function task()
    {
       return $this->belongsTo(Task::class,'id_task');
    }

	public function user_task()
    {
       return $this->belongsTo(UserTask::class,'id_h_task');
    }
}
