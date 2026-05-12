<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanyRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('company_requests')->insert([
            [
                'company_id' => 1,
                'direction_id' => 1, // Например, "Программная инженерия"
                'internship_id' => 1,
                'required_count' => 5,
                'requirements_text' => 'Знание основ SQL и опыт работы с PHP/Laravel. Ответственность и умение работать в команде.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 2,
                'direction_id' => 2, // Например, "Дизайн"
                'internship_id' => 2,
                'required_count' => 2,
                'requirements_text' => 'Владение инструментами Figma и Adobe Photoshop. Наличие портфолио будет преимуществом.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => 3,
                'direction_id' => 1,
                'internship_id' => 3,
                'required_count' => 10,
                'requirements_text' => 'Базовые знания Python и понимание принципов работы нейросетей.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}