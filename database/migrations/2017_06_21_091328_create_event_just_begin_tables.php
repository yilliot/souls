<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventJustBeginTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('e01_just_begin_records', function(Blueprint $table){
            $table->increments('id');
            $table->integer('soul_id')->unsigned()->index();
            $table->integer('cellgroup_id')->unsigned()->index();
            $table->integer('meters');
            $table->string('screenshot_path');
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
        Schema::drop('e01_just_begin_records');
    }
}
