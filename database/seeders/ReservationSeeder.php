<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Company;
use App\Models\Student;
use App\Models\Internship;

class ReservationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = Company::orderBy('id')->pluck('id')->toArray();
        $students = Student::orderBy('id')->pluck('id')->toArray();
        $internships = Internship::orderBy('id')->pluck('id')->toArray();

        if (empty($companies) || empty($students) || empty($internships)) {
            $this->command->error('Сначала заполните таблицы companies, students и internships!');
            return;
        }

        DB::table('reservations')->insert([
            [
                'company_id' => $companies[0],
                'student_id' => $students[0],
                'internship_id' => $internships[0],
                'status' => 'confirmed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => $companies[1] ?? $companies[0],
                'student_id' => $students[2] ?? $students[0],
                'internship_id' => $internships[1] ?? $internships[0],
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'company_id' => $companies[0],
                'student_id' => $students[1] ?? $students[0],
                'internship_id' => $internships[0],
                'status' => 'rejected',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}