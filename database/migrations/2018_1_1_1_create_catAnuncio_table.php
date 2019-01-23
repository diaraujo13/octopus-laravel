<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateCatAnuncioTable extends Migration
{
    /**
     * Run the migrations for Cat_anuncio.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Cat_anuncio', function (Blueprint $table) {
            $table->increments('id');
                $table->string      ('Nome' , 255);
                $table->string      ('Cor' , 255);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations value for Cat_anuncio.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Cat_anuncio');
    }
}
