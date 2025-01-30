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
        Schema::create('heures', function (Blueprint $table) {
            $table->id();
            $table->integer('heure_debut');
            $table->integer('min_debut');
            $table->integer('heure_fin');
            $table->integer('min_fin');
            $table->string('randomUser');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('heures');
    }
};
