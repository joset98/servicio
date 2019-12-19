<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;
use App\PermissionRole;

class RolesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::all();
        return view('settings.roles.index',compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        $permissions = Permission::all();
        
        $permissionsRolesInstance = [
            'permission_id' => '',
            'role_id' => ''
        ];
        $inputs = $request->all();
        PermissionRole::deleteAll();


        $permisionRolesInstance = new PermissionRole();
        foreach ($permissions as $permission){
            $permisionRolesInstance['permission_id'] = $permission->id;

            if(isset($inputs[$permission->name])){
               for ($i = 0; $i < count($inputs[$permission->name]); $i++) {
                    $permisionRolesInstance['role_id'] = $inputs[$permission->name][$i];
                    PermissionRole::insert($permisionRolesInstance);
                }
            }
        }
        
        return view('settings.roles.index',compact('permissions'));
    }
// IDPermission: 1, In 
    public function changePermission( $idPermission,$inputRow){
    }
}
