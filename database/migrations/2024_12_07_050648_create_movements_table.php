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
        Schema::create('movements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('military_id')->constrained('militaries','id')->onDelete('cascade');
            $table->foreignId('weapon_id')->constrained('weapons','id')->onDelete('cascade');
            $table->foreignId('magazine_id')->constrained('magazines','id')->onDelete('cascade');
            $table->foreignId('base_id')->constrained('bases','id')->onDelete('cascade');
            $table->date('date');
            $table->text('reason');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movements');
    }
};
