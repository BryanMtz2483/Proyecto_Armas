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
        Schema::create('credentials', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('rank_id')->constrained('ranks','id')->onDelete('cascade');
            $table->foreignId('base_id')->constrained('bases','id')->onDelete('cascade');
            $table->date('emision');
            $table->date('expiration');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('credentials');
    }
};
