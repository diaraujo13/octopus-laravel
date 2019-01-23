<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('fav');

        Schema::create('fav', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('anuncio_id');
            $table->unsignedInteger('user_id');
            $table->timestamps();

        });

        Schema::table('fav', function (Blueprint $table) {
            $table->foreign('anuncio_id')->references('id')->on('Anuncio')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fav');
    }
}
