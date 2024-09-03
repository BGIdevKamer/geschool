<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\Participant;
use App\Models\Formation;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('formation_participant', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Formation::class)->constrained()->onDelete('cascade');
            $table->foreignIdFor(Participant::class)->constrained()->onDelete('cascade');
            $table->string('anneeScolaire');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('formation_participant');
    }
};
