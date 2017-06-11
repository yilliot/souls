<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAuthTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function(Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->index();
            $table->string('password', 60)->nullable();
            $table->string('first_name', 30)->nullable();
            $table->string('last_name', 30)->nullable();
            $table->rememberToken();
            $table->integer('soul_id')->nullable();
            $table->timestamps();
        });
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('role_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->index()->foreign()->references("id")->on("roles")->onDelete("cascade");
            $table->bigInteger('user_id')->unsigned()->index()->foreign()->references("id")->on("users")->onDelete("cascade");
            $table->timestamps();
        });

        // PERMISSIONS
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('inherit_id')->unsigned()->nullable()->index();
            $table->foreign('inherit_id')->references('id')->on('permissions');
            $table->string('name')->index();
            $table->string('slug')->index();
            $table->text('description')->nullable();
            $table->timestamps();
        });
        Schema::create('permission_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned()->index();
            $table->foreign('permission_id')->references('id')->on('permissions')->onDelete('cascade');
            $table->integer('role_id')->unsigned()->index();
            $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('permission_user', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('permission_id')->unsigned()->index()->references('id')->on('permissions')->onDelete('cascade');
            $table->integer('user_id')->unsigned()->index()->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token')->index();
            $table->timestamp('created_at')->nullable();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('password_resets');
        Schema::drop('permission_user');
        Schema::drop('permission_role');
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
        Schema::drop('users');
    }
}
