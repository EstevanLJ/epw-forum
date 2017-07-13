<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostEditTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_edit', function (Blueprint $table) {
            $table->increments('id');
			
            $table->text('text');

            $table->integer('post_id')->unsigned();
            $table->foreign('post_id')->references('id')->on('post');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');

            $table->timestamp('data')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_edit');
    }
}
