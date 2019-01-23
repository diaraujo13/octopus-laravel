<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateImovelTable extends Migration
{
    /**
     * Run the migrations for Imovel.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imovel', function (Blueprint $table) {
            $table->increments('id');
                $table->unsignedInteger  ('city_id');
                $table->foreign('city_id')->references('id')->on('city')->onDelete('cascade');
                $table->text  ('Descr')->nullable();
                $table->string      ('Address' , 255);
                $table->integer  ('Qtd_quartos')->default(0)->nullable();
                $table->integer  ('Qtd_suite')->default(0)->nullable();
                $table->integer  ('Qtd_banheiros')->default(0)->nullable();
                $table->integer  ('Qtd_garagem')->default(0)->nullable();
                $table->float  ('Comp', 5, 2)->nullable();
                $table->float  ('Larg', 5, 2)->nullable();
                $table->float  ('Area_util', 5, 2)->nullable();
                $table->float  ('Area_total', 5, 2)->nullable();
                $table->float  ('Condominio', 5, 2)->nullable();
                $table->float  ('Iptu', 5, 2)->nullable();
                $table->float  ('Lat', 5, 2)->nullable();
                $table->float  ('Long', 5, 2)->nullable();
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations value for Imovel.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imovel');
    }
}
