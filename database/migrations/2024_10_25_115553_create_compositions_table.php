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
        Schema::create('compositions', function (Blueprint $table) {
            $table->id();
            $table->string('note');
            $table->string('appreciate')->nullable();
            $table->foreignId('formation_participant_id')->constrained()->onDelete('cascade');
            $table->foreign('matiere_id')->references('id')->on('matieres')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('matiere_id');
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('evaluation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('compositions');
    }
};
