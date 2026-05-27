<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\StudentInternship;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $studentInternships = StudentInternship::orderBy('id')->pluck('id')->toArray();

        if (empty($studentInternships)) {
            $this->command->error('Сначала заполните таблицу student_internships!');
            return;
        }

        DB::table('documents')->insert([
            [
                'student_internship_id' => $studentInternships[0],
                'file_path' => 'documents/internships/report_id1.pdf',
                'original_name' => 'report.pdf',
                'type' => 'final_report',
                'title' => 'Итоговый отчет',
                'label' => 'Отчет по практике',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_internship_id' => $studentInternships[1] ?? $studentInternships[0],
                'file_path' => 'documents/internships/application_id2.pdf',
                'original_name' => 'application.pdf',
                'type' => 'application',
                'title' => 'Заявление на практику',
                'label' => 'Заявление',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_internship_id' => $studentInternships[0],
                'file_path' => 'documents/internships/certificate_id1.pdf',
                'original_name' => 'certificate.pdf',
                'type' => 'certificate',
                'title' => 'Сертификат',
                'label' => 'Сертификат о прохождении',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}