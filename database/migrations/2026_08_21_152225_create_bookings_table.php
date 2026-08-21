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
    Schema::create('bookings', function (Blueprint $table) {
        $table->id();
        $table->foreignId('user_id')->constrained()->cascadeOnDelete();
        $table->foreignId('training_session_id')->constrained()->cascadeOnDelete();
        $table->enum('status', ['confirmed', 'cancelled'])->default('confirmed');
        $table->timestamps();

        // Empêche un utilisateur de réserver 2 fois la même session
        $table->unique(['user_id', 'training_session_id']);
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
