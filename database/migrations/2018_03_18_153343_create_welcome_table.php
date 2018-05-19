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
        Schema::create('welcome_chat_records', function(Blueprint $table){
            $table->increments('id');
            $table->integer('nc_id')->unsigned()->index();
            $table->integer('accompanion_id')->unsigned()->index();
            $table->text('record')->nullable();
            $table->timestamps();
        });

        Schema::create('welcome_followuppers', function(Blueprint $table){
            $table->increments('id');
            $table->integer('nc_id')->unsigned()->index();
            $table->integer('welcome_followupper_id')->unsigned()->index();
            $table->integer('assigner_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('welcome_chat_questions', function(Blueprint $table){
            $table->increments('id');
            $table->string('question');
            $table->integer('order')->unsigned()->index();
            $table->boolean('is_active')->index();
            $table->string('options')->nullable();
        });

        Schema::create('welcome_followup_comments', function(Blueprint $table){
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
        Schema::drop('welcome_chat_records');
        Schema::drop('welcome_followuppers');
        Schema::drop('welcome_chat_questions');
        Schema::drop('welcome_followup_comments');

    }
}
