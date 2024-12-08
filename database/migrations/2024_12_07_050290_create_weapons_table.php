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
        Schema::create('weapons', function (Blueprint $table) {
            $table->id();
            $table->string('model')->unique();
            $table->foreignId('weaponType_id')->constrained('weapon_types','id')->onDelete('cascade');
            $table->string('manufacturer');
            $table->enum('state', ['aviable','unaviable','delivered','delivering'])->default('aviable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weapons');
    }
};
