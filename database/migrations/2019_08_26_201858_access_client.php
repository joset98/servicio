<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AccessClient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { 
        Schema::create('access_clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_institution')->unsigned();
            $table->foreign('id_institution')->references('id')->on('institutions');
            $table->bigInteger('id_client')->unsigned();
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('cascade');
            $table->string('user')->nullable();
            $table->string('password')->nullable();
            $table->timestamps();
        }); 
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('access_clients');
    }
}
