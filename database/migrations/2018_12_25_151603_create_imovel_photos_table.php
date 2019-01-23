<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovelPhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovel_photos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->unsignedInteger('imovel_photo_tipos_id')->nullable();
            $table->foreign('imovel_photo_tipos_id')->references('id')->on('imovel_photo_tipos')->onDelete('set null');
            $table->unsignedInteger('imovel_id')->nullable();
            $table->foreign('imovel_id')->references('id')->on('imovel')->onDelete('cascade');
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
        Schema::dropIfExists('imovel_photos');
    }
}
