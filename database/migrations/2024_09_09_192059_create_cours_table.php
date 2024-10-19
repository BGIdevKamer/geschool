<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Formation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('cours', function (Blueprint $table) {
            $table->id();
            $table->string('numero')->nullable();
            $table->string('libeller');
            $table->string('desc');
            $table->foreignIdFor(Formation::class)->constrained()->onDelete('cascade');
            $table->string('videoLink')->nullable();
            $table->string('imgLink')->nullable();
            $table->string('youtubeid')->nullable();
            $table->text('Content');
            $table->string('randomUser');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cours');
    }
};
