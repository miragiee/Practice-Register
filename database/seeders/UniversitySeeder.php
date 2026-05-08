<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\University;

class UniversitySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'name' => 'МГУ',
                'city' => 'Москва',
                'contact_info' => 'info@msu.ru',
            ],
            [
                'name' => 'СПбГУ',
                'city' => 'Санкт-Петербург',
                'contact_info' => 'contact@spbu.ru',
            ],
            [
                'name' => 'ИТМО',
                'city' => 'Санкт-Петербург',
                'contact_info' => 'hello@itmo.ru',
            ],
        ];

        foreach ($data as $item) {
            University::create($item);
        }
    }
}
