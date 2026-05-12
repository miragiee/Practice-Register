<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DocumentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('documents')->insert([
            [
                'student_internship_id' => 1,
                'file_path' => 'documents/internships/report_id1.pdf',
                'type' => 'final_report',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_internship_id' => 2,
                'file_path' => 'documents/internships/application_id2.pdf',
                'type' => 'application',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'student_internship_id' => 1,
                'file_path' => 'documents/internships/certificate_id1.pdf',
                'type' => 'certificate',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}