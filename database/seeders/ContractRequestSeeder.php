<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ContractRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Получаем все существующие ID компаний и университетов
        $companyIds = DB::table('companies')->pluck('id')->toArray();
        $universityIds = DB::table('universities')->pluck('id')->toArray();

        // Если одна из таблиц пуста – выходим с предупреждением
        if (empty($companyIds) || empty($universityIds)) {
            $this->command->warn('Таблицы companies или universities пусты. Сначала заполните их.');
            return;
        }

        // Создаём 20 случайных заявок
        for ($i = 0; $i < 20; $i++) {
            DB::table('contract_requests')->insert([
                'company_id'        => fake()->randomElement($companyIds),
                'university_id'     => fake()->randomElement($universityIds),
                'company_accept'    => fake()->boolean(30), // 30% шанс true
                'university_accept' => fake()->boolean(30),
                'created_at'        => now(),
                'updated_at'        => now(),
            ]);
        }
    }
}