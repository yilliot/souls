<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoreTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cellgroups', function(Blueprint $table) {

            // relation
            $table->increments('id');
            $table->string('name');
            $table->integer('leader')->unsigned()->index()->nullable();
            $table->integer('colead1')->unsigned()->index()->nullable();
            $table->integer('colead2')->unsigned()->index()->nullable();

            // status
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();

        });

        Schema::create('baptisms', function(Blueprint $table){

            // relation
            $table->increments('id');

            // content
            $table->string('event_name')->nullable();
            $table->date('ceremony_date')->nullable();
            $table->string('pastor_name')->nullable();
            $table->string('place')->nullable();

            $table->timestamps();

        });

        Schema::create('ministries', function(Blueprint $table) {

            // relation
            $table->increments('id');
            $table->integer('leader')->nullable()->unsigned()->index();

            // status
            $table->boolean('is_active')->default(true)->index();

            // content
            $table->string('shortname');
            $table->string('fullname');

            $table->timestamps();
        });

        Schema::create('ministry_souls', function(Blueprint $table){

            // relation
            $table->increments('id');
            $table->integer('ministry_id')->unsigned()->index();
            $table->integer('soul_id')->unsigned()->index();

            $table->timestamps();
        });

        Schema::create('souls', function(Blueprint $table) {

            // relation
            $table->increments('id');
            $table->integer('cellgroup_id')->unsigned()->nullable()->index();

            // status
            $table->boolean('is_active')->default(true)->index();

            // content
            $table->string('nric')->nullable();
            $table->string('nric_fullname')->nullable();
            $table->date('birthday')->nullable();
            $table->string('nickname');
            $table->string('email')->nullable();
            $table->string('contact')->nullable();
            $table->string('contact2')->nullable();
            $table->string('address1')->nullable();
            $table->string('address2')->nullable();
            $table->string('postal_code')->nullable();

            // cache
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
        Schema::drop('baptisms');
        Schema::drop('ministries');
        Schema::drop('souls');
        Schema::drop('ministry_souls');
        Schema::drop('cellgroups');
    }
}
