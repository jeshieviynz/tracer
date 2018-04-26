<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAlumnisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alumni', function (Blueprint $table) {
            $table->increments('id');
            $table->string('Alumni_ID_Number');
            $table->string('First_Name');
            $table->string('Last_Name');
            $table->string('Middle_Name')->nullable();
            $table->string('Address');
            $table->string('Email');
            $table->boolean('Account')->nullable()->default('0');
            $table->date('Birthdate');
            $table->string('Home_Phone');
            $table->string('Mobile_Phone');
            $table->string('Course');
            $table->string('Year_Graduated');
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
        Schema::dropIfExists('alumni');
    }
}