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
        Schema::create('choixes', function (Blueprint $table) {
            $table->id();
            $table->string('is_correct');
            $table->string('content');
            $table->foreign('question_id')->references('id')->on('questions')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('question_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('choixes');
    }
};
