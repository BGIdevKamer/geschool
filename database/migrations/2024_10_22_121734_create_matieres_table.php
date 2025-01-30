e<?php

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
            Schema::create('matieres', function (Blueprint $table) {
                $table->id();
                $table->string('libeller');
                $table->string('heures')->nullable();
                $table->string('coefs');
                $table->unsignedBigInteger('categorie_id')->nullable();
                $table->string('randomUser');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('matieres');
        }
    };
