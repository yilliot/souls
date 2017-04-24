<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateJobTables extends Migration
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
            $table->string('title');
            $table->integer('leader')->unsigned()->index()->nullable();
            $table->integer('colead1')->unsigned()->index()->nullable();
            $table->integer('colead2')->unsigned()->index()->nullable();

            // status
            $table->boolean('is_active')->default(true)->index();

            // Enums/Days
            $table->tinyInteger('gather_day')->unsigned()->nullable();
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

        Schema::create('ministry_groups', function(Blueprint $table){

            // relation
            $table->increments('id');
            $table->integer('leader')->unsigned()->index();

            // status
            $table->boolean('is_active')->default(true)->index();

            // content
            $table->string('name');            
        });

        Schema::create('ministries', function(Blueprint $table){

            // relation
            $table->increments('id');
            $table->integer('leader')->unsigned()->index();

            $table->integer('ministry_group_id')->nullable()->unsigned()->index();

            // status
            $table->boolean('is_active')->default(true)->index();

            // content
            $table->string('name');

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
            $table->integer('baptism_id')->unsigned()->nullable()->index();
            $table->string('baptism_serial')->nullable();

            // status
            $table->boolean('is_active')->default(true)->index();

            // content
            $table->string('nric');
            $table->string('nric_fullname');
            $table->date('birthday');
            $table->string('nickname');
            $table->string('email');
            $table->string('contact1');
            $table->string('contact2');
            $table->string('address1');
            $table->string('address2');
            $table->string('postal_code');

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
        Schema::drop('baptism');
        Schema::drop('ministries');
        Schema::drop('ministry_groups');
        Schema::drop('souls');
        Schema::drop('ministry_souls');
        Schema::drop('cellgroups');
    }
}
