<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        
        // Creacion de roles iniciales
        $this->call(RolesPermisosSeeder::class);
        $this->call(UsersSeeder::class);
        $this->call(InstitutionsSeeder::class);
        $this->call(ClientsSeeder::class);

    }
}
