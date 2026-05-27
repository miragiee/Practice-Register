<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use App\Models\Role;
use App\Models\User;
use App\Models\University;
use App\Models\Company;
use App\Models\Internship;
use App\Models\Student;
use App\Models\StudentInternship;

class DocumentDeleteTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_delete_document_and_file_removed()
    {
        Storage::fake('public');

        $roleUni = Role::create(['name' => 'Университет']);
        $roleCompany = Role::create(['name' => 'Компания']);
        $roleAdmin = Role::create(['name' => 'Администратор']);

        $uniUser = User::factory()->create(['role_id' => $roleUni->id]);
        $companyUser = User::factory()->create(['role_id' => $roleCompany->id]);
        $adminUser = User::factory()->create(['role_id' => $roleAdmin->id]);

        $university = University::create(['user_id' => $uniUser->id, 'name' => 'U', 'inn' => '1', 'contact_person' => 'X', 'position' => 'P', 'phone' => '111']);
        $company = Company::create(['user_id' => $companyUser->id, 'name' => 'C', 'description' => 'd', 'contact_info' => 'c', 'inn' => '123', 'website' => '']);

        $internship = Internship::create(['university_id' => $university->id, 'start_date' => now()->toDateString(), 'end_date' => now()->addDays(10)->toDateString(), 'description' => 'desc', 'capacity' => 3]);

        $direction = \App\Models\Direction::create(['name' => 'D', 'description' => 'd']);

        $student = Student::create(['full_name' => 'Ivan', 'university_id' => $university->id, 'direction_id' => $direction->id, 'course' => 1, 'email' => 'a@b.test']);

        $studentInternship = StudentInternship::create(['student_id' => $student->id, 'company_id' => $company->id, 'internship_id' => $internship->id, 'status' => 'completed']);

        // Company uploads
        $this->actingAs($companyUser);

        $file = UploadedFile::fake()->create('report.pdf', 100);

        $response = $this->post('/documents/upload', [
            'student_internship_id' => $studentInternship->id,
            'file' => $file,
            'type' => 'closing',
        ]);

        $response->assertSessionHas('success');

        $document = \App\Models\Document::first();

        Storage::disk('public')->assertExists($document->file_path);

        // Admin deletes
        $this->actingAs($adminUser);

        $response = $this->delete('/documents/' . $document->id);

        $response->assertSessionHas('success');

        $this->assertDatabaseMissing('documents', ['id' => $document->id]);

        Storage::disk('public')->assertMissing($document->file_path);
    }
}
