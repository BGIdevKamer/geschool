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
        Schema::create('formation_participants', function (Blueprint $table) {
            $table->id();
            $table->foreign('participant_id')->references('id')->on('participants')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('formation_id')->references('id')->on('formations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('formation_id');
            $table->string('anneeScolaire')->nullable();
            $table->string('niv')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_participants');
    }
};
