<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('companies')->insert([
            [
                'name' => 'ТехноПром',
                'description' => 'Разработка промышленного ПО',
                'contact_info' => 'hr@technoprom.ru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ВебСтудия 360',
                'description' => 'Создание современных сайтов и приложений',
                'contact_info' => 'contact@web360.ru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'ИнноТех',
                'description' => 'Инновационные технологии и стартапы',
                'contact_info' => 'info@innotech.ru',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
