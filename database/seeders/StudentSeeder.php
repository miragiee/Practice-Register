<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\University;
use App\Models\Direction;

class StudentSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $univIds = University::pluck("id")->toArray();
        $dirIds = Direction::pluck("id")->toArray();

        if (empty($univIds) || empty($dirIds)) {
            $this->command->error(
                "Сначала заполните таблицы университетов и направлений!",
            );
            return;
        }

        $students = [
            [
                "full_name" => "Иванов Иван Иванович",
                "university_id" => $univIds[0 % count($univIds)],
                "direction_id" => $dirIds[0 % count($dirIds)],
                "course" => 1,
                "email" => "ivanov@student.edu",
            ],
            [
                "full_name" => "Петрова Анна Сергеевна",
                "university_id" => $univIds[1 % count($univIds)],
                "direction_id" => $dirIds[1 % count($dirIds)],
                "course" => 3,
                "email" => "petrova@student.edu",
            ],
            [
                "full_name" => "Сидоров Алексей Петрович",
                "university_id" => $univIds[2 % count($univIds)],
                "direction_id" => $dirIds[2 % count($dirIds)],
                "course" => 2,
                "email" => "sidorov@student.edu",
            ],
            [
                "full_name" => "Козлова Мария Дмитриевна",
                "university_id" => $univIds[0 % count($univIds)],
                "direction_id" => $dirIds[3 % count($dirIds)],
                "course" => 4,
                "email" => "kozlova@student.edu",
            ],
            [
                "full_name" => "Новиков Дмитрий Андреевич",
                "university_id" => $univIds[1 % count($univIds)],
                "direction_id" => $dirIds[0 % count($dirIds)],
                "course" => 1,
                "email" => "novikov@student.edu",
            ],
            [
                "full_name" => "Морозова Екатерина Игоревна",
                "university_id" => $univIds[2 % count($univIds)],
                "direction_id" => $dirIds[1 % count($dirIds)],
                "course" => 2,
                "email" => "morozova@student.edu",
            ],
            [
                "full_name" => "Волков Артём Николаевич",
                "university_id" => $univIds[0 % count($univIds)],
                "direction_id" => $dirIds[2 % count($dirIds)],
                "course" => 3,
                "email" => "volkov@student.edu",
            ],
            [
                "full_name" => "Соколова Виктория Олеговна",
                "university_id" => $univIds[1 % count($univIds)],
                "direction_id" => $dirIds[3 % count($dirIds)],
                "course" => 4,
                "email" => "sokolova@student.edu",
            ],
            [
                "full_name" => "Лебедев Максим Владимирович",
                "university_id" => $univIds[2 % count($univIds)],
                "direction_id" => $dirIds[0 % count($dirIds)],
                "course" => 2,
                "email" => "lebedev@student.edu",
            ],
            [
                "full_name" => "Фёдорова Ольга Александровна",
                "university_id" => $univIds[0 % count($univIds)],
                "direction_id" => $dirIds[1 % count($dirIds)],
                "course" => 1,
                "email" => "fedorova@student.edu",
            ],
        ];

        foreach ($students as $data) {
            Student::firstOrCreate(["email" => $data["email"]], $data);
        }

        $this->command->info("Студенты успешно добавлены: " . count($students));
    }
}
