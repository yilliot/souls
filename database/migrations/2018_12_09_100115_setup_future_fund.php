<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupFutureFund extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ff_sessions', function(Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->boolean('is_active');
            $table->timestamps();
        });

        Schema::create('ff_pledges', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('ff_code_id')->unsigned()->index();
            $table->string('name');
            $table->string('code')->index();
            $table->decimal('amount', 12, 2);
            $table->boolean('is_banned');
            $table->timestamps();
        });

        Schema::create('ff_payments', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('ff_pledge_id')->unsigned()->index();
            $table->decimal('amount', 12, 2);
            $table->string('remarks');
            $table->boolean('is_cleared')->default(false)->index();
            $table->boolean('is_cancelled')->default(false)->index();
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
        Schema::drop('ff_sessions');
        Schema::drop('ff_pledges');
        Schema::drop('ff_payments');
    }
}
