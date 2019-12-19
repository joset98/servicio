<?php

namespace App\Http\Controllers\Profile;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Hash;

class PerfilController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:visualizar_perfil')->only('index');
        $this->middleware('permission:actualizar_perfil')->only('edit','update');
        $this->middleware('permission:modificar_clave_perfil')->only('editPassword','updatePassword');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        return view('perfil.index',compact('user'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        return view('perfil.edit',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editPassword()
    {
        $user = Auth::user();
        return view('perfil.edit-password',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $mensajes = [
            'inputEmail.required' => 'El campo de correo es requerido',
            'inputEmail.unique' => 'El campo de correo ya se encuentra asociado a otro usuario',
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
            'inputEmail' => 'required|unique:users,email,'.$user->id.',id|email',
            'inputPhone' => 'required|min:11|max:11',
        ],$mensajes);

        $user->name= $request->inputName;
        $user->lastname= $request->inputLastName;
        $user->email= $request->inputEmail;
        $user->phone = $request->inputPhone;
        if(!$user->save()){ 
            $warning = "Ocurrio un error al intentar actualizar sus datos";
            return view('perfil.edit',compact('user','warning')); 
        } 
        $success = "Sus datos han sido actualizado exitosamente";
        return view('perfil.edit',compact('success'));

    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        $mensajes = [
            'passworda.required' => 'La contraseña actual es requerida',
            'passwordn.required' => 'La contraseña nueva es requerida',
            'passwordc.required' => 'La confirmacion de la nueva contraseña es requerida',
            'passwordc.same' => 'La confirmacion de la nueva contraseña no es valida',
            'passworda.min' => 'La contraseña actual debe ser de minimo :min caracteres',
            'passwordn.min' => 'La contraseña nueva debe ser de minimo :min caracteres',
            'passwordc.min' => 'La confirmacion de la nueva contraseña debe ser de minimo :min caracteres',
            'passworda.max' => 'La contraseña actual debe ser de máximo :max caracteres',
            'passwordn.max' => 'La contraseña nueva debe ser de máximo :max caracteres',
            'passwordc.max' => 'La confirmacion de la nueva contraseña debe ser de máximo :max caracteres',
            'passworda.passwordactual' => 'La contraseña actual es incorrecta',
        ];
        
        $validatedData = $request->validate([
            'passworda' => 'required|min:8|max:12|passwordactual',
            'passwordn' => 'required|min:8|max:12',
            'passwordc' => 'required|min:8|max:12|same:passwordn',
        ],$mensajes);

        $user->password = Hash::make($request->passwordn);
        if(!$user->save()){
            $warning = "Ocurrio un error al intentar actualizar el usuario";
            return view('perfil.index',compact('user','warning')); 
        }
        $success = "La contraseña ha sido actualizada exitosamente";
        return view('perfil.edit-password',compact('user','success'));

    }


}
