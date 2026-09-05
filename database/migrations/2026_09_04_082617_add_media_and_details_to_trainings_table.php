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
    Schema::table('trainings', function (Blueprint $table) {
        $table->string('cover_image')->nullable()->after('description');
        $table->json('gallery_images')->nullable()->after('cover_image');
        $table->text('prerequisites')->nullable()->after('gallery_images');
        $table->text('provided_equipment')->nullable()->after('prerequisites');
        $table->text('required_equipment')->nullable()->after('provided_equipment');
        $table->json('program_steps')->nullable()->after('required_equipment');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trainings', function (Blueprint $table) {
            //
        });
    }
};
