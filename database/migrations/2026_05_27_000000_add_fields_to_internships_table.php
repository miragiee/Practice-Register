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
        Schema::table('internships', function (Blueprint $table) {
            if (!Schema::hasColumn('internships', 'direction_id')) {
                $table->foreignId('direction_id')->nullable()->constrained('directions');
            }

            if (!Schema::hasColumn('internships', 'capacity')) {
                $table->integer('capacity')->default(0);
            }

            if (!Schema::hasColumn('internships', 'qualities')) {
                $table->json('qualities')->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('internships', function (Blueprint $table) {
            if (Schema::hasColumn('internships', 'qualities')) {
                $table->dropColumn('qualities');
            }

            if (Schema::hasColumn('internships', 'capacity')) {
                $table->dropColumn('capacity');
            }

            if (Schema::hasColumn('internships', 'direction_id')) {
                $table->dropConstrainedForeignId('direction_id');
            }
        });
    }
};
