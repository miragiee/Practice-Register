<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            CompanySeeder::class,
            UniversitySeeder::class,
            DirectionSeeder::class,
            StudentSeeder::class,
            InternshipSeeder::class,
            StudentInternshipSeeder::class,
            CompanyRequestSeeder::class,
            ContractSeeder::class,
            DocumentSeeder::class,
            ReservationSeeder::class,
        ]);
    }
}
