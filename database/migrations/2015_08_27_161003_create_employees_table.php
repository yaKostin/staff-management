<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->increments('id');
            $table->string('name', 128);
            $table->string('email')->unique();
            $table->string('password', 60);
            $table->integer('position_id')->unsigned();
            $table->date('hire_date');
            $table->integer('salary')->unsigned();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('position_id')
                ->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }
}
