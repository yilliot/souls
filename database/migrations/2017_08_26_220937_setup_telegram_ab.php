<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupTelegramAb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('soul_telegrams', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('soul_id')->unsigned()->nullable()->index();
            $table->integer('telegram_id')->unsigned()->nullable();
            $table->string('secret_code')->nullable()->index();

            $table->string('telegram_username');
            $table->boolean('is_active')->default(true)->index();
            $table->timestamps();
        });

        Schema::create('ab', function(Blueprint $table) {

            $table->increments('id');
            $table->string('ab_code');
            $table->timestamps();
        });

        Schema::create('ab_goal', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('soul_id')->unsigned()->index();
            $table->integer('ab_id')->unsigned()->index();
            $table->decimal('amount', 10, 2)->index();
            $table->boolean('is_completed')->default(false)->index();
            $table->timestamps();
        });

        Schema::create('ab_giving', function(Blueprint $table) {

            $table->increments('id');
            $table->integer('soul_id')->unsigned()->index();
            $table->integer('ab_id')->unsigned()->index();
            $table->decimal('amount', 10, 2)->unsigned()->index();
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
        Schema::drop('soul_telegrams');
        Schema::drop('ab');
        Schema::drop('ab_goal');
        Schema::drop('ab_giving');
    }
}
