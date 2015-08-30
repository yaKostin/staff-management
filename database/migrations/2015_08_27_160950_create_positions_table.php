<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePositionsTable extends Migration {

    /**
      * Run the migrations.
      *
      * @return void
    */
    public function up() 
    {
        Schema::create('positions', function(Blueprint $table) {
            $table->engine = 'InnoDB';
            
            $table->increments('id');
            $table->string('text', 128);
            
            // These columns are needed for Baum's Nested Set implementation to work.
            $table->integer('parent_id')->nullable()->index();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();
        });
    }

    /**
      * Reverse the migrations.
      *
      * @return void
    */
    public function down() 
    {
        Schema::drop('positions');
    }

}
