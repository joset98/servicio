<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $fillable = [
        'rif','type_rif','name', 'email', 'type', 'status',
    ];

    public function access()
    {
       return $this->hasMany(AccessClient::class,'id_client');
    }

    public function tasks()
    {
       return $this->hasMany(Task::class,'id_client');
    }
}
