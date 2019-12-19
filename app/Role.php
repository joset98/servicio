<?php 
namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{

    public function user()
    {
        return $this->belongsToMany('App\User');
    }

    public function permission()
    {
        return $this-> belongsToMany('App\Permission');
    }
}