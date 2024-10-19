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
        Schema::create('courriels', function (Blueprint $table) {
            $table->id();
            $table->foreign('participant_id')->references('id')->on('participants')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('participant_id');
            $table->foreign('user_id')->references('id')->on('users')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->text('Message');
            $table->string('sujet');
            $table->integer('is_View');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courriels');
    }
};
