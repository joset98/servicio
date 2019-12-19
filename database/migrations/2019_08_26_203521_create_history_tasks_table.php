<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoryTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_task')->unsigned()->nullable()->unique();
            $table->foreign('id_task')->references('id')->on('tasks');
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('history_tasks');
    }
}
