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
        $adminRole   = Role::where('name', 'Администратор')->first();
        $studentRole = Role::where('name', 'Студент')->first();

        if (!$adminRole || !$studentRole) {
            $this->command->error('Роли не найдены. Сначала запустите RoleSeeder!');
            return;
        }

        // ── Администратор ──────────────────────────────────────────────────
        User::firstOrCreate(
            ['email' => 'admin@admin.com'],
            [
                'role_id'  => $adminRole->id,
                'name'     => 'Администратор',
                'password' => Hash::make('password'),
            ]
        );

        // ── Студенты ────────────────────────────────────────────────────────
        $students = Student::all();

        if ($students->isEmpty()) {
            $this->command->warn('Таблица студентов пуста. Сначала запустите StudentSeeder!');
            return;
        }

        foreach ($students as $student) {
            User::firstOrCreate(
                ['email' => $student->email],
                [
                    'role_id'  => $studentRole->id,
                    'name'     => $student->full_name,
                    'password' => Hash::make('password'),
                ]
            );
        }

        $this->command->info('Пользователи успешно добавлены: 1 администратор + ' . $students->count() . ' студентов.');
        $this->command->newLine();
        $this->command->line('  Логин администратора: <info>admin@admin.com</info>  пароль: <info>password</info>');
        $this->command->line('  Логин студента:        <info>ivanov@student.edu</info>  пароль: <info>password</info>');
    }
}
