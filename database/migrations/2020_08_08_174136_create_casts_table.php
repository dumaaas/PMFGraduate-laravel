<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('casts', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('firstName');
            $table->string('lastName');
            $table->string('movieName')->nullable();
            $table->string('occupation');
            $table->string('country');
            $table->string('birthDate');
            $table->double('height');
            $table->double('favoriteCount')->default(0);
            $table->string('avatar')->default('default.jpg');
            $table->string('description', 1000)->nullable();
            $table->string('wikipedia')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('casts');
    }
}
