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
        Schema::create('service_venues', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('service_speakers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('service_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('services', function(Blueprint $table) {
            $table->increments('id');
            $table->string('topic')->index();
            $table->integer('speaker_id')->nullable()->unsigned()->index();
            $table->integer('venue_id')->nullable()->unsigned()->index();
            $table->integer('type_id')->nullable()->unsigned()->index();

            $table->datetime('at')->index();

            $table->integer('forecast_size');
            $table->integer('attendance_size');

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
        Schema::drop('service_venues');
        Schema::drop('service_speakers');
        Schema::drop('service_types');
    }
}
