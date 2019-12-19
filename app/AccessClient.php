<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccessClient extends Model
{
    protected $fillable = [
        'id_client','id_institution','user', 'password',
    ];

    public function client()
    {
       return $this->belongsTo(Client::class,'id_client');
    }

    public function institution()
    {
       return $this->belongsTo(Institution::class,'id_institution');
    }
}
