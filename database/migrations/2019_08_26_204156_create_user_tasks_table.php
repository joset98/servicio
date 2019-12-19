<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_tasks', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_task')->unsigned()->nullable();
            $table->foreign('id_task')->references('id')->on('tasks');
            $table->bigInteger('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('id_h_task')->unsigned()->nullable()->unique();
            $table->foreign('id_h_task')->references('id')->on('history_tasks')->onDelete('cascade');
            $table->enum('status', ['activo', 'inactivo']);
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
        Schema::dropIfExists('user_tasks');
    }
}
