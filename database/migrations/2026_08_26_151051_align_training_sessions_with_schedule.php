<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('training_sessions', function (Blueprint $table) {
            $table->renameColumn('start_at', 'starts_at');
            $table->renameColumn('end_at', 'ends_at');
            $table->renameColumn('capacity_max', 'capacity_override');
        });

        Schema::table('training_sessions', function (Blueprint $table) {
            $table->unsignedInteger('capacity_override')
                ->nullable()
                ->change();

            $table->index(['starts_at', 'ends_at']);
        });
    }

    public function down(): void
    {
        Schema::table('training_sessions', function (Blueprint $table) {
            $table->dropIndex(['starts_at', 'ends_at']);
        });

        Schema::table('training_sessions', function (Blueprint $table) {
            $table->unsignedInteger('capacity_override')
                ->nullable(false)
                ->change();

            $table->renameColumn('starts_at', 'start_at');
            $table->renameColumn('ends_at', 'end_at');
            $table->renameColumn('capacity_override', 'capacity_max');
        });
    }
};
