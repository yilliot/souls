<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupFollower extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('soul_leader_followers', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('leader_id')->unsigned()->index();
            $table->integer('follower_id')->unsigned()->index();
            $table->timestamps();
        });
        Schema::create('soul_connects', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('leader')->unsigned()->index();
            $table->datetime('start_at')->index();
            $table->boolean('is_public')->index()->default(false);
            $table->text('infomation');
            $table->timestamps();
        });
        Schema::create('soul_connect_members', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('soul_connect_id')->unsigned()->index();
            $table->integer('member_id')->unsigned()->index();
            $table->boolean('is_coming')->nullable();
            $table->boolean('is_attended')->nullable();
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
        Schema::drop('soul_leader_followers');
        Schema::drop('soul_connects');
        Schema::drop('soul_connect_members');
    }
}
