<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMovementsTable extends Migration
{
    public function up()
    {
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('military_id');
            $table->unsignedBigInteger('weapon_id');
            $table->unsignedBigInteger('magazine_id');
            $table->unsignedBigInteger('base_id');
            $table->date('date');
            $table->string('reason', 255);
            $table->timestamps();

            $table->foreign('military_id')->references('id')->on('militaries')->onDelete('cascade');
            $table->foreign('weapon_id')->references('id')->on('weapons')->onDelete('cascade');
            $table->foreign('magazine_id')->references('id')->on('magazines')->onDelete('cascade');
            $table->foreign('base_id')->references('id')->on('bases')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('movements');
    }
}
