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
            $table->string('code')->unique();
            $table->string('caliber');
            $table->integer('capacity');
            $table->enum('state', ['aviable','unaviable','delivered','delivering'])->default('aviable');
            $table->string('type_magazine');
            $table->timestamps();
            $table->foreign('type_magazine')->references('name')->on('magazine_types')->onDelete('cascade');
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
