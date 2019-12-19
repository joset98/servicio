<?php

namespace App\Http\Controllers\Tasks;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Task;
use App\Client;

class TasksController extends Controller
{

    public function __construct()
    {   
        $this->middleware('permission:listar_tareas')->only('index');
        $this->middleware('permission:agregar_tarea')->only('create','store','createsubmit');
        $this->middleware('permission:mostrar_tarea')->only('show');
        $this->middleware('permission:actualizar_tarea')->only('edit','update');
        $this->middleware('permission:eliminar_tarea')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            return datatables()->eloquent(Task::query())->toJson();
        }
        return view('tasks/index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('tasks.create');   
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function createsubmit($id_client)
    {
        if ($id_client != 0) {
            $client = Client::find($id_client);

            if (!$client) {
                return redirect(route('tasks.create')); 
            }
        }else {
            $client = null;
        }

        return view('tasks.createsubmit')->with(compact('client'));   
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
            'inputIdCliente.required' => 'El campo de codigo de cliente es requerido',
            'inputCedula.min' => 'El campo de cedula contener minimo :min caracteres',
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

        $task = new Task();
        $task->id_client      = $request->inputIdClient;
        $task->id_institution = $request->inputIdInstitution;
        $task->title = $request->inputTitle;
        $task->message = $request->inputMessage;
        $task->status = $request->inputStatus;
        $task->due_date = $request->inputDueDate;

        
        if (!$task->save()) {
            $warning = "Ocurrio un error al crear la tarea";
            return view('tasks/create')->with(compact('warning'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
