<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('text');

			$table->boolean('archived')->default('false');
			$table->text('archived_comment')->nullable();
			$table->integer('archived_by')->unsigned()->nullable();
            $table->foreign('archived_by')->references('id')->on('user');

            $table->integer('area_id')->unsigned();
            $table->foreign('area_id')->references('id')->on('area');

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('user');


            //Adicionar o restante dos itens

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
        Schema::dropIfExists('post');
    }
}
