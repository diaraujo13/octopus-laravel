<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateAnuncioTable extends Migration
{
    /**
     * Run the migrations for Anuncio.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Anuncio');

        Schema::create('Anuncio', function (Blueprint $table) {
            $table->increments('id');
                $table->string      ('Title' , 255);
                $table->float  ('Valor', 5, 2)->nullable();
                $table->float  ('Antigo_valor', 5, 2)->nullable();
                $table->boolean  ('Ativo')->default(true)->nullable();
                $table->date  ('Validade')->nullable();
                $table->string      ('Email' , 255);
                $table->string      ('Telefone' , 255);
                $table->string      ('Sectel' , 255);
                $table->boolean  ('Featured')->default(false)->nullable();
                $table->unsignedInteger  ('Cat_anuncio_id');
                $table->foreign('Cat_anuncio_id')->references('id')->on('Cat_anuncio')->onDelete('cascade');
                $table->unsignedInteger  ('Imovel_id');
                $table->foreign('Imovel_id')->references('id')->on('imovel')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations value for Anuncio.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Anuncio');
    }
}
