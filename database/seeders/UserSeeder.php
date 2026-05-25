<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use Illuminate\Database\Seeder;

use Illuminate\Support\Facades\Hash;

use App\Models\User;
use App\Models\Role;
use App\Models\Student;

class UserSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | ROLES
        |--------------------------------------------------------------------------
        */

        $adminRole = Role::where("name", "Администратор")->first();

        $studentRole = Role::where("name", "Студент")->first();

        $companyRole = Role::where("name", "Работодатель")->first();

        if (!$adminRole || !$studentRole || !$companyRole) {
            $this->command->error(
                "Роли не найдены. Сначала запустите RoleSeeder!",
            );

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | ADMIN
        |--------------------------------------------------------------------------
        */

        User::firstOrCreate(
            [
                "email" => "admin@admin.com",
            ],

            [
                "role_id" => $adminRole->id,

                "name" => "Администратор",

                "password" => Hash::make("password"),
            ],
        );

        /*
        |--------------------------------------------------------------------------
        | COMPANY USERS
        |--------------------------------------------------------------------------
        */

        $companies = [
            [
                "name" => "ТехноПром",

                "email" => "hr@technoprom.ru",
            ],

            [
                "name" => "ВебСтудия 360",

                "email" => "contact@web360.ru",
            ],

            [
                "name" => "ИнноТех",

                "email" => "info@innotech.ru",
            ],
        ];

        foreach ($companies as $company) {
            User::firstOrCreate(
                [
                    "email" => $company["email"],
                ],

                [
                    "role_id" => $companyRole->id,

                    "name" => $company["name"],

                    "password" => Hash::make("password"),
                ],
            );
        }

        /*
        |--------------------------------------------------------------------------
        | STUDENTS
        |--------------------------------------------------------------------------
        */

        $students = Student::all();

        if ($students->isEmpty()) {
            $this->command->warn(
                "Таблица студентов пуста. Сначала запустите StudentSeeder!",
            );

            return;
        }

        foreach ($students as $student) {
            User::firstOrCreate(
                [
                    "email" => $student->email,
                ],

                [
                    "role_id" => $studentRole->id,

                    "name" => $student->full_name,

                    "password" => Hash::make("password"),
                ],
            );
        }

        /*
        |--------------------------------------------------------------------------
        | SUCCESS
        |--------------------------------------------------------------------------
        */

        $this->command->info("Пользователи успешно добавлены.");

        $this->command->newLine();

        $this->command->line("Администратор:");

        $this->command->line("email: admin@admin.com");

        $this->command->line("password: password");

        $this->command->newLine();

        $this->command->line("Компания:");

        $this->command->line("email: hr@technoprom.ru");

        $this->command->line("password: password");

        $this->command->newLine();

        $this->command->line("Студент:");

        $this->command->line("email: ivanov@student.edu");

        $this->command->line("password: password");
    }
}
