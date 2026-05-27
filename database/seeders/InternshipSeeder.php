<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\University;
use App\Models\Direction;

class InternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universities = University::orderBy('id')->pluck('id')->toArray();
        $directions = Direction::orderBy('id')->pluck('id')->toArray();

        if (empty($universities) || empty($directions)) {
            $this->command->error('Сначала заполните таблицы университетов и направлений!');
            return;
        }

        DB::table('internships')->insert([
            [
                'university_id' => $universities[0],
                'direction_id' => $directions[0],
                'start_date' => '2024-07-01',
                'end_date' => '2024-08-31',
                'description' => 'Летняя стажировка по направлению "Системная аналитика"',
                'capacity' => 5,
                'qualities' => json_encode(['SQL', 'PHP', 'Laravel']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => $universities[1] ?? $universities[0],
                'direction_id' => $directions[1] ?? $directions[0],
                'start_date' => '2024-09-15',
                'end_date' => '2024-12-15',
                'description' => 'Осенняя практика для разработчиков мобильных приложений',
                'capacity' => 4,
                'qualities' => json_encode(['Мобильная разработка', 'UI/UX', 'Swift']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'university_id' => $universities[0],
                'direction_id' => $directions[2] ?? $directions[0],
                'start_date' => '2025-02-01',
                'end_date' => '2025-05-31',
                'description' => 'Стажировка в отделе информационной безопасности',
                'capacity' => 6,
                'qualities' => json_encode(['Кибербезопасность', 'Анализ рисков']),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}