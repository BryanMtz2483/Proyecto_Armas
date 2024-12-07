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
        Schema::create('military_weapon_license', function (Blueprint $table) {
            $table->id();
            $table->foreignId('military_id')->constrained('militaries','id')->onDelete('cascade');
            $table->foreignId('weaponLicense_id')->constrained('weapon_licenses','id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('military_weapon_license');
    }
};
