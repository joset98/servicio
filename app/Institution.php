<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{
    protected $fillable = [
        'name','url','image',
    ];

    public function accesos()
    {
       return $this->hasMany(AccessClient::class,'id_institution');
    }

    public function tasks()
    {
       return $this->hasMany(Task::class,'id_institution');
    }
}
