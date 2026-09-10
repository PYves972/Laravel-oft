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
        Schema::create('progressions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('training_id')->constrained()->cascadeOnDelete();

            // RM-35 : Taux de progression entre 0% et 100%
            $table->unsignedTinyInteger('percentage')->default(0);

            // RM-37 : Note pédagogique facultative de l'administrateur
            $table->text('notes')->nullable();

            // RM-36 : Marqueur automatique de formation terminée (quand percentage = 100)
            $table->boolean('is_completed')->default(false);

            $table->timestamps();

            // Un utilisateur a un seul enregistrement de progression par formation (RM-34)
            $table->unique(['user_id', 'training_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('progressions');
    }
};
