<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('training_sessions', function (Blueprint $table) {
            $table->dateTime('starts_at')->after('training_id');
            $table->dateTime('ends_at')->after('starts_at');

            $table->unsignedInteger('capacity_override')
                ->nullable()
                ->after('ends_at');

            $table->string('status')
                ->default('open')
                ->after('capacity_override');

            $table->index(['starts_at', 'ends_at']);
            $table->index('status');
        });
    }

    public function down(): void
    {
        Schema::table('training_sessions', function (Blueprint $table) {
            $table->dropIndex(['starts_at', 'ends_at']);
            $table->dropIndex(['status']);

            $table->dropColumn([
                'starts_at',
                'ends_at',
                'capacity_override',
                'status',
            ]);
        });
    }
};
