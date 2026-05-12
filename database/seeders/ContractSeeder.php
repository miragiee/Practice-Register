<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contracts')->insert([
            [
                'university_id' => 1,
                'company_id' => 1,
                'start_date' => '2024-01-10',
                'end_date' => '2025-01-10',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => 2,
                'company_id' => 2,
                'start_date' => '2023-06-01',
                'end_date' => '2024-06-01',
                'status' => 'expired',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => 1,
                'company_id' => 3,
                'start_date' => '2024-03-15',
                'end_date' => '2026-03-15',
                'status' => 'active',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}