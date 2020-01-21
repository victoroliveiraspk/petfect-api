<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSociableWithTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sociable_with', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('cats');
            $table->boolean('unknown');
            $table->boolean('dogs');
            $table->boolean('children');
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
        Schema::dropIfExists('sociable_with');
    }
}
