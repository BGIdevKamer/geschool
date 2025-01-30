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
        Schema::create('bulletins', function (Blueprint $table) {
            $table->id();
            $table->string('route');
            $table->string('total_point');
            $table->string('total_coef');
            $table->string('rank');
            $table->string('randomUser');
            $table->string('anneeScolaire');
            $table->foreign('evaluation_id')->references('id')->on('evaluations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('evaluation_id');
            $table->foreign('participant_id')->references('id')->on('participants')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('formation_id')->references('id')->on('formations')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('formation_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bulletins');
    }
};
