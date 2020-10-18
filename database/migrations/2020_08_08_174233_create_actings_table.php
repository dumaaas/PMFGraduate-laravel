<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateActingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('actings', function (Blueprint $table) {
            $table->primary(['movie_id', 'cast_id']);
            $table->foreignId('movie_id');
            $table->foreignId('cast_id');
            $table->timestamps();

            $table->foreign('movie_id')
            ->references('id')
            ->on('movies')
            ->onDelete('cascade');

            $table->foreign('cast_id')
            ->references('id')
            ->on('casts')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('actings');
    }
}
