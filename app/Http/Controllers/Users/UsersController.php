<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    { }
    //Obtiene la lista de users
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables(UsersController::getAll())->toJson();
        }
        return view('users/index');
    }

    public function create()
    {
        return view('users/create');
    }

    public function show($id)
    {
        return view('users/index');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);

        if ($request->ajax()) {
            if ($user->delete()) {
                return response(['msg' => 'user eliminado', 'status' => 'success']);
            }
            return response(['msg' => 'El user no pudo ser eliminado', 'status' => 'failed']);
        }
    }

    public function store(Request $request)
    {
        $user = UsersController::requestSetDataToUser($request);

        $mensajes = [
            'inputCedula.required' => 'El campo de cedula es requerido',
            'inputCedula.unique' => 'El campo de cedula ya se encuentra asociado a otro user',
            'inputCedula.min' => 'El campo de cedula contener minimo :min caracteres',
            'inputEmail.required' => 'El campo de correo es requerido',
            'inputEmail.unique' => 'El campo de correo ya se encuentra asociado a otro user',
            'inputEmail.email' => 'El campo de correo no es valido',
            'inputPhone.required' => 'El campo de telefono es requerido',
            'inputPhone.min' => 'El telefono debe contener minimo :min caracteres',
            'inputPhone.max' => 'El telefono debe contener máximo :max caracteres',
            'inputPhone.numeric' => 'El telefono debe ser sólo numerico',
            'inputName.required' => 'El nombre es requerido',
            'inputName.min' => 'El nombre debe contener minimo :min caracteres',
            'inputName.max' => 'El nombre debe contener máximo :max caracteres',
            'inputLastName.required' => 'El apellido es requerido',
            'inputLastName.min' => 'El apellido debe contener minimo :min caracteres',
            'inputLastName.max' => 'El apellido debe contener máximo :max caracteres',
        ];

        $validatedData = $request->validate([
            'inputCedula' => 'required|unique:users,cedula,' . $user->id . ',id|min:2|max:200',
            'inputName' => 'required|min:2|max:200',
            'inputLastName' => 'required|min:2|max:200',
            'inputEmail' => 'required|unique:users,email,' . $user->id . ',id|email',
            'inputPhone' => 'required|min:11|max:11',
        ], $mensajes);

        $user->password = Hash::make($request -> inputCedula);

        if (!$user->save()) {
            $warning = "Ocurrio un error al crear el usuario";
            return view('users/edit')->with(compact('user', 'warning'));
        }

        $user->deferAndAttachNewRole($request->inputRol);
        $success = "El usuario ha sido creado exitosamente";
        
        return view('users/index')->with(compact('success'));;
    }

    public function edit($id)
    {
        $user = UsersController::getOne($id)->first();
        return view('users/edit')->with(compact('user'));
    }

    public function update(Request $request)
    {
        $user =  UsersController::requestSetDataToUser( $request, User::where('cedula', $request->inputCedula)->first() );
        $mensajes = [
            'inputEmail.required' => 'El campo de correo es requerido',
            'inputEmail.unique' => 'El campo de correo ya se encuentra asociado a otro user',
            'inputEmail.email' => 'El campo de correo no es valido',
            'inputPhone.required' => 'El campo de telefono es requerido',
            'inputPhone.min' => 'El telefono debe contener minimo :min caracteres',
            'inputPhone.max' => 'El telefono debe contener máximo :max caracteres',
            'inputPhone.numeric' => 'El telefono debe ser sólo numerico',
            'inputName.required' => 'El nombre es requerido',
            'inputName.min' => 'El nombre debe contener minimo :min caracteres',
            'inputName.max' => 'El nombre debe contener máximo :max caracteres',
            'inputLastName.required' => 'El apellido es requerido',
            'inputLastName.min' => 'El apellido debe contener minimo :min caracteres',
            'inputLastName.max' => 'El apellido debe contener máximo :max caracteres',
        ];
        $validatedData = $request->validate([
            'inputName' => 'required|min:2|max:200',
            'inputLastName' => 'required|min:2|max:200',
            'inputEmail' => 'required|unique:users,email,' . $user->id . ',id|email',
            'inputPhone' => 'required|min:11|max:11',
        ], $mensajes);

        $user->deferAndAttachNewRole($request->inputRol);

        if (!$user->save()) {
            $warning = "Ocurrio un error al intentar actualizar sus datos";
            return view('users/edit')->with(compact('user', 'warning'));
        }

        $success = "Sus datos han sido actualizado exitosamente";

        return view('users/index')->with(compact('success'));
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

    public static function requestSetDataToUser( $request, $user = null){
        if(!isset($user)) {
            $user = new User();
            $user->cedula = $request->inputCedula;
          } 
                     
        $user->name = $request->inputName;
        $user->lastname = $request->inputLastName;
        $user->email = $request->inputEmail;
        $user->phone = $request->inputPhone;

        return $user;
    }

}