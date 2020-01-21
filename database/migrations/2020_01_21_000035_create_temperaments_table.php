<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTemperamentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('temperaments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('docile');
            $table->boolean('aggressive');
            $table->boolean('calm');
            $table->boolean('playful');
            $table->boolean('sociable');
            $table->boolean('aloof');
            $table->boolean('independent');
            $table->boolean('needy');
            $table->unsignedBigInteger('pet_id');
            $table->foreign('pet_id')
                ->references('id')
                ->on('pets');
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
        Schema::dropIfExists('temperaments');
    }
}
