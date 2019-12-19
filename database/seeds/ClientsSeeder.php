<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\AccessClient;

class ClientsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
    // Juridicos

    	// Cliente 1 de prueba Tortas Sonia
        $cliente = new Client();
        $cliente->name = "TORTAS SONIA, C.A.";
        $cliente->type_rif = "J";
        $cliente->rif = "401605907";
        $cliente->email = "tortassonia@gmail.com";
        $cliente->status = "activo";
        $cliente->type = "formal";
        $cliente->save();

    	// Cliente 2 de prueba Price ZO
        $cliente = new Client();
        $cliente->name = "PRICE PZO, C.A.";
        $cliente->type_rif = "J";
        $cliente->rif = "409953580";
        $cliente->email = "prizepzo@gmail.com";
        $cliente->status = "activo";
        $cliente->type = "especial";
        $cliente->save();


    // Naturales

    	// Cliente 3 de prueba Mayckol Machado
        $cliente = new Client();
        $cliente->name = "MAYCKOL MACHADO";
        $cliente->type_rif = "V";
        $cliente->rif = "266629660";
        $cliente->email = "lokcyam@gmail.com";
        $cliente->status = "activo";
        $cliente->type = "ordinario";
        $cliente->save();


    // Generando accesos a usuarios (del 1 al 2 son juridicos)
        for ($i=1; $i < 4 ; $i++) {

            // Accesos
            $seniat = new AccessClient();
            $seniat->user = "Prueba1";
            $seniat->password = "Prueba2";
            if ($i>2) {
                $seniat->id_institution = "1";
            } else {
                $seniat->id_institution = "2";
            }
            $seniat->id_client = $i;
            $seniat->save();

            $faov = new AccessClient();
            $faov->user = "Prueba3";
            $faov->password = "Prueba4";
            $faov->id_institution = "5";
            $faov->id_client = $i;
            $faov->save();

            $sim = new AccessClient();
            $sim->user = "prueba@mail.com";
            $sim->password = "Prueba6";
            $sim->id_institution = "6";
            $sim->id_client = $i;
            $sim->save();

            // Accesos solo para juridicos
            if ($i<3) {

                $ivss = new AccessClient();
                $ivss->user = "Prueba7";
                $ivss->password = "Prueba8";
                $ivss->id_institution = "3";
                $ivss->id_client = $i;
                $ivss->save();

                $inces = new AccessClient();
                $inces->user = "Prueba9";
                $inces->password = "Prueba10";
                $inces->id_institution = "4";
                $inces->id_client = $i;
                $inces->save();

            }
        }
        
    }
}
