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
        Schema::create('militaries', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->bigInteger('phone');
            $table->date('birth_date');
            $table->date('join_date');
            $table->foreignId('credential_id')->constrained('credentials','id')->onDelete('cascade');
            $table->foreignId('weaponLicense_id')->constrained('weapon_licenses','id')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('militaries');
    }
};
