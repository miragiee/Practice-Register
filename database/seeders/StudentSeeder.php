<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\University;
Use App\Models\Direction;

class StudentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем существующие ID, чтобы не указывать их вручную
        $univIds = University::pluck('id')->toArray();
        $dirIds = Direction::pluck('id')->toArray();

        // Проверка: если в базе пусто, сидер не сработает
        if (empty($univIds) || empty($dirIds)) {
            $this->command->error('Сначала заполните таблицы университетов и направлений!');
            return;
        }

        $students = [
            [
                'full_name' => 'Иванов Иван Иванович',
                'university_id' => $univIds[array_rand($univIds)],
                'direction_id' => $dirIds[array_rand($dirIds)],
                'course' => 1,
                'email' => 'ivanov@example.com',
            ],
            [
                'full_name' => 'Петрова Анна Сергеевна',
                'university_id' => $univIds[array_rand($univIds)],
                'direction_id' => $dirIds[array_rand($dirIds)],
                'course' => 3,
                'email' => 'petrova@example.com',
            ],
            [
                'full_name' => 'Сидоров Алексей Петрович',
                'university_id' => $univIds[array_rand($univIds)],
                'direction_id' => $dirIds[array_rand($dirIds)],
                'course' => 2,
                'email' => 'sidorov@example.com',
            ],
        ];

        foreach ($students as $student) {
            Student::create($student);
        }
    }
}
