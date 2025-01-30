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
        Schema::create('emploies', function (Blueprint $table) {
            $table->id();
            $table->foreign('formation_id')->references('id')->on('formations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('formation_id');
            $table->string('randomUser');
            $table->string('anneeScolaire');
            $table->string('date_debut');
            $table->string('date_fin');
            $table->string('note')->nullable();
            $table->string('titre');
            $table->string('niveau')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('emploies');
    }
};
