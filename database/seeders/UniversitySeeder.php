<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\University;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                "name" => "МГУ",
                "email" => "info@msu.ru",
                "password" => "password",
                "inn" => "7701234567",
                "description" => "Ведущий университет с сильными инженерными направлениями",
                "contact_person" => "Иванов Иван Иванович",
                "position" => "Декан",
                "phone" => "+7 (999) 111-11-11",
            ],

            [
                "name" => "СПбГУ",
                "email" => "contact@spbu.ru",
                "password" => "password",
                "inn" => "7801234567",
                "description" => "Крупный классический университет с разнообразными направлениями",
                "contact_person" => "Петров Пётр Петрович",
                "position" => "Ректор",
                "phone" => "+7 (999) 222-22-22",
            ],

            [
                "name" => "ИТМО",
                "email" => "hello@itmo.ru",
                "password" => "password",
                "inn" => "7811111111",
                "description" => "Технологический университет, сильный в ИТ и прикладных науках",
                "contact_person" => "Сидоров Сергей Сергеевич",
                "position" => "Проректор",
                "phone" => "+7 (999) 333-33-33",
            ],
        ];

        foreach ($data as $item) {
            /*
            |--------------------------------------------------------------------------
            | Создание пользователя
            |--------------------------------------------------------------------------
            */

            $user = User::firstOrCreate([
                'email' => $item['email'],
            ], [
                "name" => $item["name"],
                "password" => Hash::make($item["password"]),
                "role_id" => 2,
            ]);

            /*
            |--------------------------------------------------------------------------
            | Создание университета
            |--------------------------------------------------------------------------
            */

            \App\Models\University::updateOrCreate([
                'user_id' => $user->id,
            ], [
                "name" => $item["name"],
                "inn" => $item["inn"],
                "description" => $item["description"] ?? null,
                "contact_person" => $item["contact_person"],
                "position" => $item["position"],
                "phone" => $item["phone"],
            ]);
        }
    }
}
