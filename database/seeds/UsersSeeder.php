<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;


class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('users')->truncate();
        
        
    	 // Obteniendo los Roles iniciales
         $admin = Role::where('name','=','administrador')->first();
         $empleado = Role::where('name','=','empleado')->first();
         $pasante = Role::where('name','=','pasante')->first();
        
        // ---------------------------ADMIN CREATE
        DB::table('users')->insert([
            'name' => 'admin',
            'lastname' => 'user',
            'cedula' => '12345678',
            'phone' => '04141234567',
            'email' => 'superadmin@sidir.com',
            'password' => Hash::make('12345678'),
        ]);

         //$user_admin = User::where('cedula', '=','12345678')->first();
         //$user_admin->attachRole($admin); 
         $count =20;

         factory(App\User::class, $count)->create();

         $usersBD = User::all();


         foreach( $usersBD as $user){

            if($user->id == 1){
             $user->attachRole($admin);
            } 
            else {
                $pasant_or_employer = rand(1,20);

                if( $pasant_or_employer < 15){
                    $user->attachRole($empleado);
                }
                else{
                    $user->attachRole($pasante);
                    }
                
            }
         }

    }
}
