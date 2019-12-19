<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PermissionRole extends Model
{
    const ADMIN=1;
    const EMPLEADO=2;
    const PASANTE=3;

    protected $fillable = [
        'permission_id','role_id'
    ];

    public function permission()
    {
        return $this-> hasMany('App\Permission');
    }

    public function Role()
    {
        return $this-> hasMany('App\Role');
    }
    

    public static function existPermissionRole( $idPermission, $idRol){
        return \DB::table('permission_role')
            ->where('permission_id', $idPermission)
            ->where('role_id', $idRol)
            ->exists();
    }

    public static function deleteAll()
    {
        \DB::table('permission_role')->delete();
    }

    public static function deleteOne($idPermission)
    {
        \DB::table('permission_role')->where('permission_id', '=', $idPermission)->delete();
    }

    public static function insert( $permission){

        \DB::table('permission_role')->insert(
            [
             'permission_id' => $permission['permission_id'], 
             'role_id' => $permission['role_id']
            ]
        );
    }
}
