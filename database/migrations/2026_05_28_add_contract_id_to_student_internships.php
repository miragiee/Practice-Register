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
        Schema::table('student_internships', function (Blueprint $table) {
            $table->foreignId('contract_id')->nullable()->after('internship_id')->constrained('contracts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_internships', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['contract_id']);
            $table->dropColumn('contract_id');
        });
    }
};
