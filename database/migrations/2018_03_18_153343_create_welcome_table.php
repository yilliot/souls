<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWelcomeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
          //
        Schema::create('welcome_chat_record', function(Blueprint $table){
            $table->increments('id');
            $table->integer('nc_id')->unsigned()->index();
            $table->integer('accomponian_id')->unsigned()->index();
            $table->text('record')->nullable();
            $table->timestamps();
        });

        Schema::create('welcome_followupper', function(Blueprint $table){
            $table->increments('id');
            $table->integer('nc_id')->unsigned()->index();
            $table->integer('welcome_followupper_id')->unsigned()->index();
            $table->integer('assigner_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('welcome_chat_question', function(Blueprint $table){
            $table->increments('id');
            $table->integer('question')->unsigned()->index();
            $table->integer('order')->unsigned()->index();
            $table->boolean('is_active')->index();
            $table->string('options')->nullable();
        });

        Schema::create('welcome_followup_comment', function(Blueprint $table){
            $table->increments('id');
            $table->integer('nc_id')->unsigned()->index();
            $table->integer('followupper_id')->unsigned()->index();
            $table->text('comment')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('welcome_chat_record');
        Schema::drop('welcome_followupper');
        Schema::drop('welcome_chat_question');
        Schema::drop('welcome_followup_comment');

    }
}
