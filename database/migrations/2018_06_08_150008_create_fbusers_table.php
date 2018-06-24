<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFbusersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fbusers', function(Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('soul_id')->nullable()->unsigned();
            $table->text('token');
            $table->string('refresh_token')->nullable();
            $table->string('expires_in')->nullable();
            $table->bigInteger('facebook_id')->unsigned()->index();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->boolean('verified')->nullable();
            $table->string('avatar');
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
        Schema::drop('fbusers');
    }
}
