<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use Notifiable;
    use EntrustUserTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','lastname','cedula', 'email', 'phone', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function historytasks()
    {
       return $this->hasMany(HistoryTask::class,'id_user');
    }

    public function tasks()
    {
       return $this->hasMany(UserTask::class,'id_user');
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

   public function rol(){
        $firstRole = $this->roles->first();
        return $firstRole['display_name'];
    }
    public function deferAndAttachNewRole($role) {
        // remove any roles tagged in this user.
        foreach ($this->roles as $userRole) {
            $this->roles()->detach($userRole->id);
        }

        // attach the new role using the `EntrustUserTrait` `attachRole()`
        $this->attachRole($role);

    }

    public static function getAll()
    {
        return \DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.cedula',
                'users.name',
                'users.lastname',
                'users.email',
                'users.phone',
                'users.password',
                'users.status',
                'roles.name as r_name'
            );
    }

    public static function getOne($id)
    {
        return \DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select(
                'users.id',
                'users.cedula',
                'users.name',
                'users.lastname',
                'users.email',
                'users.phone',
                'users.password',
                'users.status',
                'roles.name as r_name'
            )->where('users.id', '=', $id);;
    }

    public static function getUserRolName( $cedula){
        return \DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'role_user.role_id', '=', 'roles.id')
            ->select(
                'roles.name'
            )->where('users.cedula', '=', $cedula)->first()->name;
    }

}
