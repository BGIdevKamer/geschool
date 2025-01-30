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
        Schema::create('sessions', function (Blueprint $table) {
            $table->id();
            $table->foreign('matiere_id')->references('id')->on('matieres')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('matiere_id')->nullable();
            $table->foreign('enseigant_id')->references('id')->on('enseigants')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('enseigant_id')->nullable();
            $table->foreign('salle_id')->references('id')->on('salles')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('salle_id')->nullable();
            $table->foreign('emploie_id')->references('id')->on('emploies')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('emploie_id');
            $table->unsignedBigInteger('heure_id');
            $table->string('jour');
            $table->string('cpp');
            $table->string('randomUser');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sessions');
    }
};
