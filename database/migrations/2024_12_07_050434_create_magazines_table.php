<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('magazines', function (Blueprint $table) {
            $table->id();
            $table->string('caliber');
            $table->integer('capacity');
            $table->foreignId('weapon_id')->constrained('weapons','id')->onDelete('cascade');
            $table->enum('stock', ['aviable','unaviable','delivered'])->default('aviable');
            $table->string('model_magazine');
            $table->timestamps();
            $table->foreign('model_magazine')->references('model')->on('weapons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('magazines');
    }
};
