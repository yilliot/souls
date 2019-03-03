<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_venues', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
        });

        Schema::create('session_speakers', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
        });

        Schema::create('session_types', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
        });

        Schema::create('sessions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable()->index();
            $table->integer('speaker_id')->nullable()->unsigned()->index();
            $table->integer('venue_id')->nullable()->unsigned()->index();
            $table->integer('type_id')->nullable()->unsigned()->index();
            $table->datetime('start_at')->index();
            $table->datetime('end_at')->nullable()->index();
            $table->boolean('is_church_wide')->default(true)->index();
            $table->integer('cg_id')->nullable()->unsigned()->index();
            $table->text('remarks')->nullable();

            $table->integer('created_by')->index();

            $table->integer('forecast_size')->unsigned()->default(0);
            $table->integer('attendance_size')->unsigned()->default(0);

            $table->timestamps();
        });

        Schema::create('session_invitations', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id')->unsigned()->index();
            $table->integer('cg_id')->nullable()->unsigned()->index();
            $table->integer('soul_id')->nullable()->unsigned()->index();
            $table->boolean('is_visitor')->default(false);
            $table->string('visitor_name')->nullable();
            $table->integer('invitor_id')->nullable()->unsigned()->index();
            $table->boolean('is_coming')->nullable();
            $table->boolean('is_attended')->nullable();

            $table->timestamps();
        });

    }

    public function down()
    {
        Schema::drop('sessions');
        Schema::drop('session_speakers');
        Schema::drop('session_venues');
        Schema::drop('session_types');
        Schema::drop('session_invitations');
    }
}
