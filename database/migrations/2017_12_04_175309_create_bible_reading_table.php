<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBibleReadingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('e03_check_ins', function(Blueprint $table){
            $table->increments('id');
            $table->integer('soul_id')->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('e03_check_in_chapters', function(Blueprint $table){
            $table->increments('id');
            $table->integer('check_in_id')->unsigned()->index();
            $table->integer('chapter_id')->unsigned()->index();
            $table->integer('cellgroup_id')->unsigned()->index();
            $table->integer('comment_id')->nullable()->unsigned()->index();
            $table->timestamps();
        });

        Schema::create('e03_comments', function(Blueprint $table){
            $table->increments('id');
            $table->integer('check_in_chapter_id')->unsigned()->index();
            $table->integer('soul_id')->unsigned()->index();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->timestamps();
        });

        Schema::create('e03_chapters', function(Blueprint $table){
            $table->increments('id');
            $table->string('book_name');
            $table->integer('chapter_number');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('e03_check_ins');
        Schema::drop('e03_check_in_chapters');
        Schema::drop('e03_comments');
        Schema::drop('e03_chapters');

    }
}
