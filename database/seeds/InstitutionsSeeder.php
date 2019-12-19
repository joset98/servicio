<?php

use Illuminate\Database\Seeder;
use App\Institution;

class InstitutionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	// Seniat personas naturales
        $seniatn = new Institution();
        $seniatn->name = "SENIAT (personas naturales)";
        $seniatn->url = "http://contribuyente.seniat.gob.ve/iseniatlogin/contribuyente.do";
        $seniatn->image = "seniat.png";
        $seniatn->save();

    	// Seniat personas juridicas
        $seniatj = new Institution();
        $seniatj->name = "SENIAT (personas jurídicas)";
        $seniatj->url = "http://contribuyente.seniat.gob.ve/iseniatlogin/juridico.do";
        $seniatj->image = "seniat.png";
        $seniatj->save();


    	// Ivss
        $ivss = new Institution();
        $ivss->name = "IVSS";
        $ivss->url = "http://autoliquidacionv2.ivss.gob.ve:28080/TiunaWeb/login.htm";
        $ivss->image = "ivss.png";
        $ivss->save();

    	// Inces
        $inces = new Institution();
        $inces->name = "INCES";
        $inces->url = "http://rncp.inces.gob.ve/rncp/";
        $inces->image = "inces.png";
        $inces->save();

    	// Faov
        $FAOV = new Institution();
        $FAOV->name = "FAOV BANAVIH";
        $FAOV->url = "http://faovel.banavih.gob.ve/";
        $FAOV->image = "faov.png";
        $FAOV->save();

        // Alcaldia
        $alcaldia = new Institution();
        $alcaldia->name = "SIM - Alcaldia de caroni";
        $alcaldia->url = "http://stributoscaroni.gconex.com/sim/frontend/web/index.php?r=site%2Flogin";
        $alcaldia->image = "alcaldia.png";
        $alcaldia->save();
    }
}
