<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImovelPhotoTiposTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('imovel_photo_tipos');

        Schema::create('imovel_photo_tipos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('tipo');
            $table->timestamps();
        });
    

        DB::table('imovel_photo_tipos')->insert([
            [   
                'tipo' => 'Normal'
            ],
            [
                'tipo' => 'Planta'
            ],
            [
                'tipo' => 'Foto Aérea'
            ],
            [
                'tipo' => 'Localização'
            ],

        ]);
    
    }


    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imovel_photo_tipos');
    }
}
