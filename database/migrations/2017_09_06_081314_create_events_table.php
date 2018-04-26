<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('venue');
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->dateTime('start');
            $table->dateTime('end');
            $table->string('status')->default('upcoming');
            $table->longText('description')->nullable();
            $table->string('eventBatch');
            $table->string('backgroundColor')->default("#0fa5bb")->nullable();
            $table->string('textColor')->default("#0fa5bb")->nullable();
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
        
        Schema::dropIfExists('events');
    }
}

