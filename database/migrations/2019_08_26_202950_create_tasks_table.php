<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_client')->unsigned()->nullable();
            $table->foreign('id_client')->references('id')->on('clients')->onDelete('set null');;
            $table->bigInteger('id_institution')->unsigned()->nullable();
            $table->foreign('id_institution')->references('id')->on('institutions');
            $table->string('title');
            $table->string('message');
            $table->date('due_date');
            $table->enum('status', ['sin hacer', 'asignado', 'en proceso', 'por revisar', 'lista']);
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
        Schema::dropIfExists('tasks');
    }
}
