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
        Schema::create('exercice_participants', function (Blueprint $table) {
            $table->id();
            $table->string('score')->nullable();
            $table->foreign('participant_id')->references('id')->on('participants');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('exercice_id')->references('id')->on('exercices');
            $table->unsignedBigInteger('exercice_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercice_participants');
    }
};
