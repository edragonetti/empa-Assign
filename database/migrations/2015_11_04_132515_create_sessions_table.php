<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('sessionid',60);
            $table->integer('deviceid')->index();
            $table->integer('userid')->index();
            $table->integer('elapsed');
            $table->timestamps();
            
            //$table->foreign('userid')->references('id')->on('users');
            //$table->foreign('deviceid')->references('id')->on('devices');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sessions');
    }
}
