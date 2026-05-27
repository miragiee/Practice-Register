<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Company;
use App\Models\Internship;

class StudentInternshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $students = Student::orderBy('id')->pluck('id')->toArray();
        $companies = Company::orderBy('id')->pluck('id')->toArray();
        $internships = Internship::orderBy('id')->pluck('id')->toArray();

        if (empty($students) || empty($companies) || empty($internships)) {
            $this->command->error('Сначала заполните таблицы students, companies и internships!');
            return;
        }

        DB::table('student_internships')->insert([
            [
                'student_id' => $students[0],
                'company_id' => $companies[0],
                'internship_id' => $internships[0],
                'status' => 'completed',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students[1] ?? $students[0],
                'company_id' => $companies[1] ?? $companies[0],
                'internship_id' => $internships[1] ?? $internships[0],
                'status' => 'in_progress',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_id' => $students[2] ?? $students[0],
                'company_id' => $companies[0],
                'internship_id' => $internships[0],
                'status' => 'pending',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
