<?php

namespace App\Http\Controllers\Clients;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
use App\AccessClient;
use App\Institution;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:listar_clientes')->only('index');
        $this->middleware('permission:agregar_cliente')->only('create','store');
        $this->middleware('permission:mostrar_cliente')->only('show');
        $this->middleware('permission:actualizar_cliente')->only('edit','update');
        $this->middleware('permission:eliminar_cliente')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->eloquent(Client::query())->toJson();
        }
        return view('clients/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clients.create');    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {

        $mensajes = [
            'inputTypeRif.required' => 'El tipo de rif es requerido',
            'inputRif.required' => 'El campo de RIF es requerido',
            'inputRif.unique' => 'El campo de RIF ya se encuentra asociado a otro cliente',
            'inputRif.min' => 'El RIF debe contener minimo :min caracteres',
            'inputRif.max' => 'El RIF debe contener máximo :max caracteres',
            'inputRif.numeric' => 'El RIF debe ser sólo numerico',
            'inputName.required' => 'El nombre es requerido',
            'inputName.min' => 'El nombre debe contener minimo :min caracteres',
            'inputName.max' => 'El nombre debe contener máximo :max caracteres',
            'inputEmail.required' => 'El campo de correo es requerido',
            'inputEmail.unique' => 'El campo de correo ya se encuentra asociado a otro cliente',
            'inputEmail.email' => 'El campo de correo no es valido',
            'inputStatus.required' => 'El estado de cliente es requerido',
            'inputTC.required' => 'El tipo de contribuyente es requerido',
            'inputSeniatUsuario.max' => 'El usuario del seniat debe contener máximo :max caracteres',
            'inputSeniatPassword.max' => 'La contraseña del SENIAT debe contener máximo :max caracteres',
            'inputFAOVUsuario.max' => 'El usuario del FAOV debe contener máximo :max caracteres',
            'inputFAOVPassword.max' => 'La contraseña del FAOV debe contener máximo :max caracteres',
            'inputSIMEmail.max' => 'El usuario del SIM debe contener máximo :max caracteres',
            'inputSIMPassword.max' => 'La contraseña del SIM debe contener máximo :max caracteres',
            'inputIVSSnpatrono.max' => 'El usuario del IVSS debe contener máximo :max caracteres',
            'inputIVSSPassword.max' => 'La contraseña del IVSS debe contener máximo :max caracteres',
            'inputINCESUsuario.max' => 'El usuario del INCES debe contener máximo :max caracteres',
            'inputINCESPassword.max' => 'La contraseña del INCES debe contener máximo :max caracteres',
        ];

        // Validar datos básicos
        $validatedData = $request->validate([
            'inputTypeRif' => 'required',
            'inputRif' => 'required|unique:clients,rif|min:9|max:9',
            'inputName' => 'required|min:5|max:200',
            'inputEmail' => 'required|unique:clients,email|email',
            'inputStatus' => 'required',
            'inputTC' => 'required',
        ],$mensajes);

        $client = new Client();
        $client->type_rif = $request->inputTypeRif;
        $client->rif = $request->inputRif;
        $client->name = $request->inputName;
        $client->email = $request->inputEmail;
        $client->status = $request->inputStatus;
        $client->type = $request->inputTC;

        // validar Acces clients

        // Validar datos Seniat
        $validatedData = $request->validate([
            'inputSeniatUsuarioatUsuario' => 'max:50',
            'inputSeniatPassword' => 'max:20',
        ],$mensajes);

        $seniat = new AccessClient();
        $seniat->user = $request->inputSeniatUsuario;
        $seniat->password = $request->inputSeniatPassword;
        if ($request->inputTypeRif=="J") {
            $seniat->id_institution = "2";
        } else {
            $seniat->id_institution = "1";
        }

        // Validar datos FAOV
        $validatedData = $request->validate([
            'inputFAOVUsuario' => 'max:12',
            'inputFAOVPassword' => 'max:20',
        ],$mensajes);

        $faov = new AccessClient();
        $faov->user = $request->inputFAOVUsuario;
        $faov->password = $request->inputFAOVPassword;
        $faov->id_institution = "5";

        // Validar datos SIM
        $validatedData = $request->validate([
            'inputSIMEmail' => 'max:50',
            'inputSIMPassword' => 'max:20',
        ],$mensajes);

        $sim = new AccessClient();
        $sim->user = $request->inputSIMEmail;
        $sim->password = $request->inputSIMPassword;
        $sim->id_institution = "6";


        // Personas Juridicas
        if ($request->inputTypeRif=="J") {

            // Validar datos IVSS
            $validatedData = $request->validate([
                'inputIVSSnpatrono' => 'max:15',
                'inputIVSSPassword' => 'max:20',
            ],$mensajes);

            $ivss = new AccessClient();
            $ivss->user = $request->inputIVSSnpatrono;
            $ivss->password = $request->inputIVSSPassword;
            $ivss->id_institution = "3";

            // Validar datos INCES
            $validatedData = $request->validate([
                'inputINCESUsuario' => 'max:10',
                'inputINCESPassword' => 'max:20',
            ],$mensajes);

            $inces = new AccessClient();
            $inces->user = $request->inputINCESUsuario;
            $inces->password = $request->inputINCESPassword;
            $inces->id_institution = "4";

        }


        if (!$client->save()) {
            $warning = "Ocurrio un error al crear el usuario";
            return view('clients/create')->with(compact('warning'));
        }

        // asignando ID usuario
        $seniat->id_client = $client->id;
        $seniat->save();

        $faov->id_client = $client->id;
        $faov->save();

        $sim->id_client = $client->id;
        $sim->save();


        // Personas Juridicas
        if ($request->inputTypeRif=="J") {
            $ivss->id_client = $client->id;
            $ivss->save();
            $inces->id_client = $client->id;
            $inces->save();
        }

        $success = "El cliente ha sido agregado exitosamente";        
        return view('clients/index')->with(compact('success'));;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $cliente = Client::find($id);
        if (!$cliente) {
            return redirect(route('clients.index')); 
        }
        return view('clients/show')->with(compact('cliente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Client::find($id);
        if (!$cliente) {
            return redirect(route('clients.index')); 
        }
        return view('clients/edit')->with(compact('cliente'));
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
        $cliente = Client::find($id);
        if (!$cliente) {
            return redirect(route('clients.index')); 
        }

        $mensajes = [
            'inputTypeRif.required' => 'El tipo de rif es requerido',
            'inputRif.required' => 'El campo de RIF es requerido',
            'inputRif.unique' => 'El campo de RIF ya se encuentra asociado a otro cliente',
            'inputRif.min' => 'El RIF debe contener minimo :min caracteres',
            'inputRif.max' => 'El RIF debe contener máximo :max caracteres',
            'inputRif.numeric' => 'El RIF debe ser sólo numerico',
            'inputName.required' => 'El nombre es requerido',
            'inputName.min' => 'El nombre debe contener minimo :min caracteres',
            'inputName.max' => 'El nombre debe contener máximo :max caracteres',
            'inputEmail.required' => 'El campo de correo es requerido',
            'inputEmail.unique' => 'El campo de correo ya se encuentra asociado a otro cliente',
            'inputEmail.email' => 'El campo de correo no es valido',
            'inputTC.required' => 'El tipo de contribuyente es requerido',
            'inputStatus.required' => 'El estado de cliente es requerido',
            'inputSeniatUsuario.max' => 'El usuario del seniat debe contener máximo :max caracteres',
            'inputSeniatPassword.max' => 'La contraseña del SENIAT debe contener máximo :max caracteres',
            'inputFAOVUsuario.max' => 'El usuario del FAOV debe contener máximo :max caracteres',
            'inputFAOVPassword.max' => 'La contraseña del FAOV debe contener máximo :max caracteres',
            'inputSIMEmail.max' => 'El usuario del SIM debe contener máximo :max caracteres',
            'inputSIMPassword.max' => 'La contraseña del SIM debe contener máximo :max caracteres',
            'inputIVSSnpatrono.max' => 'El usuario del IVSS debe contener máximo :max caracteres',
            'inputIVSSPassword.max' => 'La contraseña del IVSS debe contener máximo :max caracteres',
            'inputINCESUsuario.max' => 'El usuario del INCES debe contener máximo :max caracteres',
            'inputINCESPassword.max' => 'La contraseña del INCES debe contener máximo :max caracteres',
        ];

        // Validar datos básicos
        $validatedData = $request->validate([
            'inputName' => 'required|min:5|max:200',
            'inputEmail' => 'required|unique:clients,email,'.$cliente->id.',id|email',
            'inputStatus' => 'required',
            'inputTC' => 'required',
        ],$mensajes);

        $cliente->name = $request->inputName;
        $cliente->email = $request->inputEmail;
        $cliente->status = $request->inputStatus;
        $cliente->type = $request->inputTC;

        // validar Acces clients

        // Validar datos Seniat
        $validatedData = $request->validate([
            'inputSeniatUsuarioatUsuario' => 'max:50',
            'inputSeniatPassword' => 'max:20',
        ],$mensajes);

        $seniat = new AccessClient();
        if ($cliente->type_rif =="J") {
            $seniat = AccessClient::where('id_client','=',$cliente->id)->where('id_institution','=','2')->first();
        } else {
            $seniat = AccessClient::where('id_client','=',$cliente->id)->where('id_institution','=','1')->first();
        }
        $seniat->user = $request->inputSeniatUsuario;
        $seniat->password = $request->inputSeniatPassword;

        // Validar datos FAOV
        $validatedData = $request->validate([
            'inputFAOVUsuario' => 'max:12',
            'inputFAOVPassword' => 'max:20',
        ],$mensajes);

        $faov = AccessClient::where('id_client','=',$cliente->id)->where('id_institution','=','5')->first();
        $faov->user = $request->inputFAOVUsuario;
        $faov->password = $request->inputFAOVPassword;

        // Validar datos SIM
        $validatedData = $request->validate([
            'inputSIMEmail' => 'max:50',
            'inputSIMPassword' => 'max:20',
        ],$mensajes);

        $sim = AccessClient::where('id_client','=',$cliente->id)->where('id_institution','=','6')->first();
        $sim->user = $request->inputSIMEmail;
        $sim->password = $request->inputSIMPassword;



        // Personas Juridicas
        if ($cliente->type_rif=="J") {
            // Validar datos IVSS
            $validatedData = $request->validate([
                'inputIVSSnpatrono' => 'max:15',
                'inputIVSSPassword' => 'max:20',
            ],$mensajes);

            $ivss = AccessClient::where('id_client','=',$cliente->id)->where('id_institution','=','3')->first();
            $ivss->user = $request->inputIVSSnpatrono;
            $ivss->password = $request->inputIVSSPassword;

            // Validar datos INCES
            $validatedData = $request->validate([
                'inputINCESUsuario' => 'max:10',
                'inputINCESPassword' => 'max:20',
            ],$mensajes);

            $inces = AccessClient::where('id_client','=',$cliente->id)->where('id_institution','=','4')->first();
            $inces->user = $request->inputINCESUsuario;
            $inces->password = $request->inputINCESPassword;

        }

        if(!$cliente->save() || !$seniat->save() || !$faov->save() || !$sim->save()){ 

            $warning = "Ocurrio un error al intentar actualizar los datos del cliente";
            return view('clients.show',compact('cliente','warning')); 
        }

        if ($cliente->type_rif =="J" && (!$ivss->save() || !$inces->save()) ) {

            $warning = "Ocurrio un error al intentar actualizar los datos del cliente";
            return view('clients.show',compact('cliente','warning')); 
        }

        $success = "Los datos del cliente han sido actualizados exitosamente";
        return view('clients.show',compact('cliente','success'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $cliente = Client::findOrFail($id);

        if ($request->ajax()) {
            if ($cliente->delete()) {
                return response(['msg' => 'El Cliente fue eliminado exitosamente', 'status' => 'success']);
            }
            return response(['msg' => 'El Cliente no pudo ser eliminado', 'status' => 'failed']);
        }
    }
}
