<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTask extends Model
{
    protected $fillable = [
        'id_user','id_task','id_h_task',
    ];

    public function user()
    {
       return $this->belongsTo(User::class,'id_user');
    }

	public function task()
    {
       return $this->belongsTo(Task::class,'id_task');
    }

	public function history_task()
    {
       return $this->belongsTo(HistoryTask::class,'id_h_task');
    }
}
