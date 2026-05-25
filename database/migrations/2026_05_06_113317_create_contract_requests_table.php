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
        Schema::create('contract_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                  ->constrained('companies')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->foreignId('university_id')
                  ->constrained('universities')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->boolean('company_accept')->default(false);
            $table->boolean('university_accept')->default(false);
            $table->timestamps(); // создаст created_at и updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contract_request');
    }
};