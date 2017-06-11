<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServiceAttendanceTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->index();
            $table->string('pastor');
            $table->datetime('at')->index();

            $table->timestamps();
        });

        Schema::create('service_attendances', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('service_id')->index();
            $table->integer('soul_id')->index();
            $table->boolean('is_attended');

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
        Schema::drop('service_attendances');
        Schema::drop('services');
    }
}
