<?php

namespace App\Http\Controllers\Settings;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Institution;

class InstitutionController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:listar_instituciones')->only('index');
        $this->middleware('permission:actualizar_institucion')->only('edit','update');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institution::All();
        return view('settings.institutions.index',compact('instituciones'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institucion = Institution::find($id);
        if (!$institucion) {
            return redirect(route('home')); 
        }
        return view('settings.institutions.edit',compact('institucion'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $institucion = Institution::find($id);
        if (!$institucion) {
            return redirect(route('home')); 
        }

        $mensajes = [
            'inputUrl.required' => 'El campo de URL es requerido',
            'inputUrl.min' => 'La URL debe contener minimo :min caracteres',
            'inputUrl.max' => 'La URL debe contener máximo :max caracteres',
        ];

        $validatedData = $request->validate([
            'inputUrl' => 'required|min:5|max:200',
        ],$mensajes);

        $institucion->url = $request->inputUrl;

        if(!$institucion->save()){ 
            $warning = "Ocurrio un error al intentar actualizar los datos de la institucion";
            return view('settings.institutions.edit',compact('institucion','warning')); 
        } 
        $success = "La institucion ha sido actualizada exitosamente";
        return view('settings.institutions.edit',compact('institucion','success'));
    }

}
