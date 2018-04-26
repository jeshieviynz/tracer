<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableAddForeignKeys extends Migration
{
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
                $table->foreign('role_id')->references('id')->on('roles')->onDelete('cascade');
                $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('cascade');
            });

        Schema::table('Employability', function (Blueprint $table) {
                $table->foreign('alumni_id')->references('id')->on('alumni')->onDelete('cascade');
         });

         Schema::table('companydetails', function (Blueprint $table) {
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

         Schema::table('companydetails', function(Blueprint $table){
            Schema::disableForeignKeyConstraints();
        });

         Schema::table('alumni', function(Blueprint $table){
            Schema::disableForeignKeyConstraints();
        });

         Schema::table('Employability', function(Blueprint $table){
            Schema::disableForeignKeyConstraints();
        });

         Schema::table('users', function(Blueprint $table){
            Schema::disableForeignKeyConstraints();
        }); 

 
    }
}



