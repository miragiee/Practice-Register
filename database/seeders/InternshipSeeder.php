<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('internships')->insert([
            [
                'university_id' => 1,
                'start_date' => '2024-07-01',
                'end_date' => '2024-08-31',
                'description' => 'Летняя стажировка по направлению "Системная аналитика"',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => 2,
                'start_date' => '2024-09-15',
                'end_date' => '2024-12-15',
                'description' => 'Осенняя практика для разработчиков мобильных приложений',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => 1,
                'start_date' => '2025-02-01',
                'end_date' => '2025-05-31',
                'description' => 'Стажировка в отделе информационной безопасности',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}