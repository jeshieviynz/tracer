<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumniPositionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('positions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('position');
            $table->rememberToken();
            $table->timestamps();
        });
  

        Schema::table('alumniOfficers', function (Blueprint $table) {
        $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('cascade');
         });

       

    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('positions');

         Schema::table('alumniOfficers', function(Blueprint $table){
        Schema::disableForeignKeyConstraints();
        });
    }
}
