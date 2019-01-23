<?php
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
class CreateProfileTable extends Migration
{
    /**
     * Run the migrations for Profile.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('Profile');

        Schema::create('Profile', function (Blueprint $table) {
            $table->increments('id');
                $table->string      ('Name' , 255);
                $table->date  ('Birthday')->nullable();
                $table->unsignedInteger  ('City_id');
                $table->foreign('City_id')->references('id')->on('city')->onDelete('cascade');
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations value for Profile.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Profile');
    }
}
