<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Direction;

class DirectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $directions = [
            [
                'name' => 'Информационные системы',
                'description' => 'Разработка ПО, администрирование баз данных и сетей.',
            ],
            [
                'name' => 'Прикладная информатика',
                'description' => 'Внедрение ИТ-решений в бизнес-процессы.',
            ],
            [
                'name' => 'Дизайн',
                'description' => 'Графический дизайн, UI/UX и веб-разработка.',
            ],
            [
                'name' => 'Экономика',
                'description' => 'Бухгалтерский учет, аудит и мировая экономика.',
            ],
        ];

        foreach ($directions as $data) {
            // Ищет по имени, если нет — создает, если есть — обновляет описание
            Direction::updateOrCreate(['name' => $data['name']], $data);
        }
    }
}
