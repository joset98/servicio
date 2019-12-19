<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\Permission;

class RolesPermisosSeeder extends Seeder
{
    private function GetAllRol()
    {
        return array(
            'admin' => $this->createRol($this->DataToArray('administrador', 'Administrador')),
            'pasante' => $this->createRol($this->DataToArray('empleado', 'Empleado')),
            'empleado' => $this->createRol($this->DataToArray('pasante', 'Pasante'))
        );
    }

    private function createRol($data)
    {
        return new Role($data);
    }

    private function chargeRolsToBD($rols)
    {
        foreach ($rols as $rol) {
            $rol->save();
        }
    }

    private function getPermissionGeneral()
    {
        return array(
            'rolesView' => $this->createPermission(
                $this->DataToArray('visualizar_permisos', 'Lista los Permisos')
            ),
            'rolesUpdate' => $this->createPermission(
                $this->DataToArray('modificar_permisos', 'Modificar los Permisos')
            ),
            'listar_usuarios' => $this->createPermission(
                $this->DataToArray('listar_usuarios', 'Listar_usuarios')

            ),
            'menu_perfil' => $this->createPermission(
                $this->DataToArray('opcion_perfil', 'Opciones de perfil')
            ),
            'vperfil' => $this->createPermission(
                $this->DataToArray('visualizar_perfil', 'Visualizar perfil')
            ),
            'aperfil' => $this->createPermission(
                $this->DataToArray('actualizar_perfil', 'Actualizar perfil')
            ),
            'cperfil' => $this->createPermission(
                $this->DataToArray('modificar_clave_perfil', 'Modificacion de contraseña de perfil')
            ),
            'usersAdd' => $this->createPermission(
                $this->DataToArray('agregar_nuevo_usuario', 'Agregar un nuevo usuario')
            ),
            'usersDelete' => $this->createPermission(
                $this->DataToArray('eliminar_usuario', 'Eliminar un usuario')
            ),
            'usersUpdate' => $this->createPermission(
                $this->DataToArray('actualizar_usuario', 'Modificar datos del usuario')
            ),
            'usersShow' => $this->createPermission(
                $this->DataToArray('visualizar_usuarios', 'Mostrar un nuevo usuario')
            ),
            'menu_configuracion' => $this->createPermission(
                $this->DataToArray('opcion_configuracion', 'Opciones de configuracion')
            ),
            'listar_institutions' => $this->createPermission(
                $this->DataToArray('listar_instituciones', 'Listar instituciones')
            ),
            'institutionsEdit' => $this->createPermission(
                $this->DataToArray('actualizar_institucion', 'Modificar instituciones')
            ),
            'menu_clientes' => $this->createPermission(
                $this->DataToArray('opcion_clientes', 'Opciones de clientes')
            ),
            'listar_clients' => $this->createPermission(
                $this->DataToArray('listar_clientes', 'Listar clientes')
            ),
            'clientsAdd' => $this->createPermission(
                $this->DataToArray('agregar_cliente', 'Agregar clientes')
            ),
            'clientsShow' => $this->createPermission(
                $this->DataToArray('mostrar_cliente', 'Consultar cliente')
            ),
            'clientsEdit' => $this->createPermission(
                $this->DataToArray('actualizar_cliente', 'Modificar cliente')
            ),
            'clientsDelete' => $this->createPermission(
                $this->DataToArray('eliminar_cliente', 'Eliminar cliente')
            ),
            'menu_tareas' => $this->createPermission(
                $this->DataToArray('opcion_tareas', 'Opciones de Tareas')
            ),
            'listar_Tasks' => $this->createPermission(
                $this->DataToArray('listar_tareas', 'Listar Tareas')
            ),
            'TasksAdd' => $this->createPermission(
                $this->DataToArray('agregar_tarea', 'Agregar Tarea')
            ),
            'TasksShow' => $this->createPermission(
                $this->DataToArray('mostrar_tarea', 'Consultar Tarea')
            ),
            'TasksEdit' => $this->createPermission(
                $this->DataToArray('actualizar_tarea', 'Modificar Tarea')
            ),
            'TasksDelete' => $this->createPermission(
                $this->DataToArray('eliminar_tarea', 'Eliminar Tarea')
            ),

        );
    }

    private function chargePermissionToBD($permissions)
    {
        foreach ($permissions as $permission) {
            $permission->save();
        }
    }
   
    private function createPermission($data)
    {
        return new Permission($data);
    }

    private function rolAttachPermission($rol, $permissions)
    {
        foreach ($permissions as $permission) {
            $rol->attachPermission($permission);
        }
    }

    private function DataToArray($name, $display_name)
    {
        return  array('name' => $name, 'display_name' => $display_name);
    }

    
    public function run()
    {
        $permissionGeneral = $this->getPermissionGeneral();
        $rols = $this->GetAllRol();

        $this->chargeRolsToBD($rols);
        $this->chargePermissionToBD($permissionGeneral);

        $this->rolAttachPermission($rols['admin'], $permissionGeneral);
        $this->rolAttachPermission($rols['empleado'], $permissionGeneral);
        $this->rolAttachPermission($rols['pasante'], $permissionGeneral);
    }
}
