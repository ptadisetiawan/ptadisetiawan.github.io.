<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('CASCADE');
            $table->integer('propinsi_id')->unsigned();
            $table->foreign('propinsi_id')->references('id')->on('propinsis')->onDelete('CASCADE');
            $table->integer('kabupaten_id')->unsigned();
            $table->foreign('kabupaten_id')->references('id')->on('kabupatens')->onDelete('CASCADE');
            $table->integer('kecamatan_id')->unsigned();
            $table->foreign('kecamatan_id')->references('id')->on('kecamatans')->onDelete('CASCADE');
            $table->string('title');
            $table->text('body');
            $table->string('photo')->nullable();
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
        Schema::dropIfExists('posts');
    }
}
