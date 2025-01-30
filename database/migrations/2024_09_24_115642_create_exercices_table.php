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
        Schema::create('exercices', function (Blueprint $table) {
            $table->id();
            $table->string('libeller');
            $table->text('description');
            $table->time('duree');
            $table->unsignedBigInteger('cour_id')->nullable()->nullable();
            $table->unsignedBigInteger('formation_id')->nullable()->nullable();
            $table->unsignedBigInteger('module_id')->nullable()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('exercices');
    }
};
